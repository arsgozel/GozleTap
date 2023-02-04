<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Attribute::orderBy('sort_order')
            ->with(['values' => function ($query) {
                $query->withCount([
                    'jobs as jobs_count' => function ($query) {
                        $query->where('stock', '>', 0);
                    },
                ]);
            }])
            ->paginate(50);

        return view('admin.attribute.index')
            ->with([
                'objs' => $objs,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_tm' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'job_name' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        $obj = Attribute::create([
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'job_name' => $request->product_name ?: 0,
            'sort_order' => $request->sort_order,
        ]);

        return to_route('admin.attributes.index')
            ->with([
                'success' => trans('app.attribute') . ' (' . $obj->getName() . ') ' . trans('app.added') . '!'
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = Attribute::findOrFail($id);

        return view('admin.attribute.edit')
            ->with([
                'obj' => $obj,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_tm' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'job_name' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        $obj = Attribute::updateOrCreate([
            'id' => $id,
        ], [
            'name_tm' => $request->name_tm,
            'name_en' => $request->name_en ?: null,
            'job_name' => $request->job_name ?: 0,
            'sort_order' => $request->sort_order,
        ]);

        return to_route('admin.attributes.index')
            ->with([
                'success' => trans('app.attribute') . ' (' . $obj->getName() . ') ' . trans('app.updated') . '!'
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
        $obj = Attribute::withCount('values')
            ->findOrFail($id);
        $objName = $obj->getName();
        if (in_array($obj->id, [1, 2, 3]) or $obj->values_count > 0) {
            return redirect()->back()
                ->with([
                    'error' => trans('app.error') . '!'
                ]);
        }
        $obj->delete();

        return redirect()->back()
            ->with([
                'success' => trans('app.attribute') . ' (' . $objName . ') ' . trans('app.deleted') . '!'
            ]);
    }
}
