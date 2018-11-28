<?php

namespace App\Http\Controllers\Admin;

use App\Models\Listing;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    function __invoke()
    {
        //listings count
        $total_listings = Listing::count();

        //total users
        $total_users = User::count();

        //users with listings
        $users_with_listings = User::has('listings', '>', 0)->count();

        //users with live listings
        $users_with_live_listings = User::whereHas('listings', function ($query) {
            $query->where('live', 1);
        }, '>', 0)->count();

        //latest listings
        $latest_listings = Listing::with(['user', 'area'])->isLive()->latestFirst()->paginate();

        //live listings count
        $total_live_listings = $latest_listings->total();

        return view('admin.dashboard.index', [
            'total_listings' => $total_listings,
            'total_live_listings' => $total_live_listings,
            'total_users' => $total_users,
            'users_with_listings' => $users_with_listings,
            'users_with_live_listings' => $users_with_live_listings,
            'latest_listings' => $latest_listings,
        ]);
    }


}
