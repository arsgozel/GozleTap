<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthAttempt;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\User;
use App\Models\Location;
use App\Models\Job;
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
        ];


        return view('admin.dashboard.index')
            ->with([
                'modals' => $modals,
            ]);
    }
}
