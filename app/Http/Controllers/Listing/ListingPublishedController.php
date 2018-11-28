<?php

namespace App\Http\Controllers\Listing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingPublishedController extends Controller
{

    /**
     * ListingPublishedController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    function __invoke(Request $request)
    {
        //get user's unpublished listings
        $listings = $request->user()->listings()->with(['area'])->isLive()->latestFirst()->paginate();

        return view('user.listings.published.index', compact('listings'));
    }


}
