<?php

namespace App\Http\Controllers\Listing;

use App\Models\Area;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingFavouriteController extends Controller
{
    /**
     * ListingFavouriteController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listings = $request->user()->favouriteListings()->with(['user', 'area'])->paginate();

        return view('user.listings.favourites.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Area $area
     * @param Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Area $area, Listing $listing)
    {
        $request->user()->favouriteListings()->syncWithoutDetaching([$listing->id]);

        return back()->withSuccess('Listing added to favourites.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Area $area
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Area $area, Listing $listing)
    {
        $request->user()->favouriteListings()->detach($listing);

        return back()->withSuccess('"' . $listing->title . '" listing removed from favourites.');
    }
}
