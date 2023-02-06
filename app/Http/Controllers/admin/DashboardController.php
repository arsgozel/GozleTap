<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthAttempt;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\User;
use App\Models\Location;
use App\Models\Job;
use App\Models\Contact;
use App\Models\Verification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $modals = [
            ['name' => 'jobs', 'total' => Job::count()],
            ['name' => 'users', 'total' => User::count()],
            ['name' => 'categories', 'total' => Category::count()],
            ['name' => 'attributes', 'total' => Attribute::count()],
            ['name' => 'contacts', 'total' => Contact::count()],
            ['name' => 'locations', 'total' => Location::count()],
        ];

        $topViewed = Job::with('user')
            ->orderBy('viewed', 'desc')
            ->orderBy('favorites', 'desc')
            ->take(10)
            ->get();

        $mostFavorites = Job::with('user')
            ->orderBy('favorites', 'desc')
            ->orderBy('viewed', 'desc')
            ->take(10)
            ->get();

        $newJobs = Job::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard.index')
            ->with([
                'modals' => $modals,
                'topViewed' => $topViewed,
                'mostFavorites' => $mostFavorites,
                'newJobs' => $newJobs,
            ]);
    }
}
