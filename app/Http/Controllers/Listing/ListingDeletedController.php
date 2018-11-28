<?php

namespace App\Http\Controllers\Listing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingDeletedController extends Controller
{

    /**
     * ListingDeletedController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    function __invoke(Request $request)
    {
        //get user's unpublished listings
        $listings = $request->user()->listings()->onlyTrashed()->with(['area'])->latestDelete()->paginate();

        return view('user.listings.deleted.index', compact('listings'));
    }
}
