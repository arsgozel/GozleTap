<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Job;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:255',
            'has_jobs' => 'nullable|boolean',
            'has_favorites' => 'nullable|boolean',
        ]);
        $q = $request->q ?: null;
        $f_hasJobs = $request->has('has_jobs') ? $request->has_job : null;
        $f_hasFavorites = $request->has('has_favorites') ? $request->has_favorites : null;

        $objs = Customer::when($q, function ($query, $q) {
            return $query->where(function ($query) use ($q) {
                $query->orWhere('name', 'like', '%' . $q . '%');
                $query->orWhere('username', 'like', '%' . $q . '%');
            });
        })
            ->when(isset($f_hasJobs), function ($query) use ($f_hasJobs) {
                if ($f_hasJobs) {
                    return $query->has('jobs');
                } else {
                    return $query->doesntHave('jobs');
                }
            })

            ->when(isset($f_hasFavorites), function ($query) use ($f_hasFavorites) {
                if ($f_hasFavorites) {
                    return $query->has('favorites');
                } else {
                    return $query->doesntHave('favorites');
                }
            })
            ->orderBy('id', 'desc')
            ->withCount(['jobs', 'favorites'])
            ->paginate(50)
            ->withQueryString();

        return view('admin.customer.index')
            ->with([
                'objs' => $objs,
            ]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $objs = Customer::findOrFail($id);

        return view('admin.customer.edit')
            ->with([
                'objs' => $objs
            ]);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
