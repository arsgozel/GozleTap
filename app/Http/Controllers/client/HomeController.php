<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $modals = [
            ['name' => 'jobs', 'total' => Job::count()],
        ];

        $topViewed = Job::with('user')
            ->orderBy('viewed', 'desc')
            ->orderBy('favorites', 'desc')
            ->where('is_approved', 1)
            ->take(8)
            ->get();

        $mostFavorites = Job::with('user')
            ->orderBy('favorites', 'desc')
            ->orderBy('viewed', 'desc')
            ->where('is_approved', 1)
            ->take(8)
            ->get();

        $newJobs = Job::with('user')
            ->orderBy('created_at', 'desc')
            ->where('is_approved', 1)
            ->take(8)
            ->get();

        return view('client.home.index')
            ->with([
                'modals' => $modals,
                'topViewed' => $topViewed,
                'mostFavorites' => $mostFavorites,
                'newJobs' => $newJobs,
            ]);
    }

    public function language($key)
    {
        if ($key == 'en') {
            session()->put('locale', 'en');
        } else {
            session()->put('locale', 'tm');
        }
        return redirect()->back();
    }
}
