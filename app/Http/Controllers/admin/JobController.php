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
}