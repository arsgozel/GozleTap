<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Loсation;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $new = Job::where('created_at', '>=', Carbon::today()->subMonth()->toDateString())
            ->with(['category:id,name_tm,name_en','location:id,name_tm,name_en', 'images'])
            ->inRandomOrder()
            ->take(4)
            ->get([
                'id', 'category_id', 'location_id', 'name_tm', 'slug', 'salary', 'created_at'
            ]);

        return view('client.home.index', [
            'new' => $new,
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
