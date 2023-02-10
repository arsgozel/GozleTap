<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:255',
            'u' => 'nullable|array', // users
            'u.*' => 'nullable|integer|min:0|distinct',
            'c' => 'nullable|array', // categories
            'c.*' => 'nullable|integer|min:0|distinct',
            'l' => 'nullable|array', // locations
            'l.*' => 'nullable|integer|min:0|distinct',
            'v' => 'nullable|array', // values
            'v.*' => 'nullable|array',
            'v.*.*' => 'nullable|integer|min:0|distinct',
        ]);
        $q = $request->q ?: null;
        $f_users = $request->has('u') ? $request->u : [];
        $f_categories = $request->has('c') ? $request->c : [];
        $f_locations = $request->has('l') ? $request->l : [];
        $f_values = $request->has('v') ? $request->v : [];

        $jobs = Job::when($q, function ($query, $q) {
            return $query->where(function ($query) use ($q) {
                $query->orWhere('full_name_tm', 'like', '%' . $q . '%');
                $query->orWhere('full_name_en', 'like', '%' . $q . '%');
                $query->orWhere('slug', 'like', '%' . $q . '%');
            });
        })
            ->when($f_users, function ($query, $f_users) {
                $query->whereIn('user_id', $f_users);
            })
            ->when($f_categories, function ($query, $f_categories) {
                $query->whereIn('category_id', $f_categories);
            })
            ->when($f_locations, function ($query, $f_locations) {
                $query->whereIn('location_id', $f_locations);
            })
            ->when($f_values, function ($query, $f_values) {
                return $query->where(function ($query) use ($f_values) {
                    foreach ($f_values as $f_value) {
                        $query->whereHas('attributeValues', function ($query) use ($f_value) {
                            $query->whereIn('id', $f_value);
                        });
                    }
                });
            })
            ->with('user')
            ->paginate(24);

        $jobs = $jobs->appends([
            'q' => $q,
            'u' => $f_users,
            'c' => $f_categories,
            'l' => $f_locations,
            'v' => $f_values,
        ]);
        // FILTER
        $users = User::orderBy('name')
            ->get();

        $categories = Category::orderBy('sort_order')
            ->orderBy('slug')
            ->get();

        $locations = Location::orderBy('sort_order')
            ->get();

        $attributes = Attribute::with('values')
            ->orderBy('sort_order')
            ->get();

        return view('client.job.index')
            ->with([
                'q' => $q,
                'f_users' => collect($f_users),
                'f_categories' => collect($f_categories),
                'f_locations' => collect($f_locations),
                'f_values' => collect($f_values)->collapse(),
                'jobs' => $jobs,
                'users' => $users,
                'categories' => $categories,
                'locations' => $locations,
                'attributes' => $attributes,
            ]);
    }


    public function show($slug)
    {
        $job = Job::where('slug', $slug)
            ->with('user', 'category', 'attributeValues.attribute')
            ->firstOrFail();

        $category = Category::findOrFail($job->category_id);
        $location = Location::findOrFail($job->location_id);
        $jobs = Job::where('category_id', $category->id)
            ->where( 'location_id', $location->id)
            ->with('user')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('client.job.show')
            ->with([
                'job' => $job,
                'category' => $category,
                'location' => $location,
                'jobs' => $jobs,
            ]);
    }
}
