<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:255',
            'category' => 'nullable|integer|min:1|exists:categories,id',
            'users' => 'nullable|integer|min:1|exists:users,id',
        ]);

        $q = $request->q ?: null;
        $f_category = $request->category ?: null;
        $f_users = $request->users ?: null;

        $objs = Job::when($q, function ($query, $q) {
            return $query->where(function ($query) use ($q) {
                $query->orWhere('name_tm', 'like', '%' . $q . '%');
                $query->orWhere('name_en', 'like', '%' . $q . '%');
                $query->orWhere('full_name_tm', 'like', '%' . $q . '%');
                $query->orWhere('full_name_en', 'like', '%' . $q . '%');
                $query->orWhere('slug', 'like', '%' . $q . '%');
                $query->orWhere('salary', 'like', '%' . $q . '%');
            });
        })
            ->when($f_category, function ($query, $f_category) {
                $query->where('category_id', $f_category);
            })
            ->when($f_users, function ($query, $f_users) {
                $query->where('user_id', $f_users);
            })
            ->with(['user','category.parent'])
            ->orderBy('id','desc')
            ->paginate(50)
            ->withQueryString();

        $categories = Category::whereNotNull('parent_id')->withCount('jobs')
            ->orderBy('sort_order')
            ->get();
        $users = User::orderBy('name')
            ->get();

        return view('admin.job.index')
            ->with([
                'objs' => $objs,
                'categories' => $categories,
                'f_category' => $f_category,
                'user' => $users,
            ]);
    }


    public function create()
    {
        $categories = Category::whereNotNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        $attributes = Attribute::orderBy('sort_order')
            ->with('values')
            ->get();

        return view('admin.job.create')
            ->with([
                'categories' => $categories,
                'attributes' => $attributes,
            ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|min:1',
            'gender' => 'nullable|integer|min:1',
            'education' => 'nullable|integer|min:1',
            'work_time' => 'nullable|integer|min:1',
            'experience' => 'nullable|integer|min:1',
            'name_tm' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'images' => 'nullable|array|min:0',
            'images.*' => 'nullable|image|mimes:jpg,jpeg|max:128|dimensions:width=1000,height=1000',
        ]);
        $category = Category::findOrFail($request->brand);
        $gender = $request->has('gender') ? AttributeValue::findOrFail($request->gender) : null;
        $education = $request->has('education') ? AttributeValue::findOrFail($request->education) : null;
        $work_time = $request->has('work_time') ? AttributeValue::findOrFail($request->work_time) : null;
        $experience = $request->has('experience') ? AttributeValue::findOrFail($request->experience) : null;

        $fullNameTm = $request->name_tm . ' '
            . $category->name_tm;
        $fullNameEn = $request->name_en . ' '
            . $category->name_en;

        $obj = Job::create([
            'category_id' => $category->id,
            'gender_id' => $gender->id ?: null,
            'education_id' => $education->id ?: null,
            'work_time_id' => $work_time->id ?: null,
            'experience_id' => $experience->id ?: null,
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'full_name_tm' => isset($fullNameTm) ? $fullNameTm : null,
            'full_name_en' => isset($fullNameEn) ? $fullNameEn : null,
            'slug' => str()->slug($fullNameTm) . '-' . str()->random(10),
            'salary' => $request->salary,
            'is_approved' => $request->user_id == 1,
        ]);

        if ($request->has('images')) {
            $firstImageName = "";
            $i = 0;
            foreach ($request->images as $image) {
                $name = str()->random(10) . '.' . $image->extension();
                if ($i == 0) {
                    $firstImageName = $name;
                }
                Storage::putFileAs('public/j', $image, $name);
                JobImage::create([
                    'job_id' => $obj->id,
                    'image' => $name,
                ]);
                $i += 1;
            }
            $obj->image = $firstImageName;
            $obj->update();
        }

        return to_route('admin.jobs.index')
            ->with([
                'success' => @trans('app.job') . $obj->getName() . @trans('app.added') . '!'
            ]);
    }


    public function edit($id)
    {
        $obj = Job::findOrFail($id);

        $categories = Category::whereNotNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        $attributes = Attribute::orderBy('sort_order')
            ->with('values')
            ->get();

        $images = JobImage::where('job_id', $id)
            ->get();

        return view('admin.job.edit')
            ->with([
                'obj' => $obj,
                'categories' => $categories,
                'attributes' => $attributes,
                'images' => $images,
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|integer|min:1',
            'gender' => 'required|integer|min:1',
            'education' => 'required|integer|min:1',
            'work_time' => 'required|integer|min:1',
            'experience' => 'required|min:1',
            'name_tm' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'salary' => 'required|numeric|min:0',
            'images' => 'nullable|array|min:0',
            'images.*' => 'nullable|image|mimes:jpg,jpeg|max:260|dimensions:width=1000,height=1000',
        ]);
        $category = Category::findOrFail($request->category);
        $gender = AttributeValue::findOrFail($request->gender);
        $education =  AttributeValue::findOrFail($request->education);
        $work_time =  AttributeValue::findOrFail($request->work_time);
        $experience = AttributeValue::findOrFail($request->experience);

        $fullNameTm = $request->name_tm . ' '
            . $category->name_tm;
        $fullNameEn = $request->name_en . ' '
            . $category->name_en;

        $obj = Job::findOrFail($id);
        $obj->category_id = $category->id;
        $obj->gender_id = $gender->id;
        $obj->education_id = $education->id;
        $obj->work_time_id = $work_time->id;
        $obj->experience_id = $experience->id;
        $obj->name_tm = $request->name_tm;
        $obj->name_en = $request->name_en ?: null;
        $obj->full_name_tm = isset($fullNameTm) ? $fullNameTm : null;
        $obj->full_name_en = isset($fullNameEn) ? $fullNameEn : null;
        $obj->slug = str()->slug($fullNameTm) . '-' . str()->random(10);
        $obj->salary = $request->salary;
        $obj->update();


        if ($request->has('images')) {
            $firstImageName = "";
            $i = 0;
            foreach ($request->images as $image) {
                $name = str()->random(10) . '.' . $image->extension();
                if ($i == 0) {
                    $firstImageName = $name;
                }
                Storage::putFileAs('public/p', $image, $name);
                JobImage::create([
                    'job_id' => $obj->id,
                    'image' => $name,
                ]);
                $i += 1;
            }
            $obj->image = $firstImageName;
            $obj->update();
        }

        return to_route('admin.jobs.index')
            ->with([
                'success' => trans('app.job') . ' (' . $obj->getName() . ') ' . trans('app.updated') . '!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images = JobImage::where('job_id', $id)
            ->get();
        if (count($images) > 0){
            foreach ($images as $image)
            {
                Storage::delete('public/j/' . $image);
            }
        }

        $obj = Job::findOrFail($id);
        $objName = $obj->getFullName();
        $obj->delete();

        return redirect()->back()
            ->with([
                'success' => trans('app.job') . ' (' . $objName . ') ' . trans('app.deleted') . '!'
            ]);
    }
}