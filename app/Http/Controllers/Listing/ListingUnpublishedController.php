<?php

namespace App\Http\Controllers\Listing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingUnpublishedController extends Controller
{

    /**
     * ListingUnpublishedController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    function __invoke(Request $request)
    {
        //get user's unpublished listings
        $listings = $request->user()->listings()->with(['area'])->isNotLive()->latestFirst()->paginate();

        return view('user.listings.unpublished.index', compact('listings'));
    }

}
