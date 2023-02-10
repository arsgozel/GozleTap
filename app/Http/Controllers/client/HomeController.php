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
        $topViewed = Job::with('user')
            ->orderBy('viewed', 'desc')
            ->orderBy('favorites', 'desc')
            ->take(12)
            ->get();

        $mostFavorites = Job::with('user')
            ->orderBy('favorites', 'desc')
            ->orderBy('viewed', 'desc')
            ->take(12)
            ->get();

        $newJobs = Job::with('user')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        return view('client.home.index')
            ->with([
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
