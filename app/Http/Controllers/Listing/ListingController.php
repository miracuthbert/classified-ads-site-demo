<?php

namespace App\Http\Controllers\Listing;

use App\Http\Requests\StoreListingFormRequest;
use App\Jobs\UserViewedListing;
use App\Models\Area;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    /**
     * ListingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create', 'store', 'edit', 'update', 'destroy',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Area $area
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Area $area, Category $category)
    {
        $listings = Listing::with(['user', 'area', 'viewedUsers'])->isLive()->inArea($area)->fromCategory($category)->latestFirst()->paginate(10);

        return view('listings.index', compact('listings', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreListingFormRequest|Request $request
     * @param Area $area
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListingFormRequest $request, Area $area)
    {
        $listing = new Listing();
        $listing->title = $request->input('title');
        $listing->body = $request->input('body');
        $listing->area_id = $request->input('area');
        $listing->category_id = $request->input('category');
        $listing->user()->associate($request->user());
        $listing->live = false;

        //save
        if ($listing->save())
            return redirect()->route('listings.edit', [$area, $listing])
                ->withSuccess('Listing saved. Make changes or proceed to payment for it to be live.');

        //error
        return back()->withInput()->withError('Listing saving error. Please try again!');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Area $area
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Area $area, Listing $listing)
    {
        if (!$listing->live()) {
            abort(404);
        }

        if ($request->user()) { //check if user signed in and log view
            dispatch(new UserViewedListing($request->user(), $listing));
        }

        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Area $area
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Area $area, Listing $listing)
    {
        //check if authorized
        $this->authorize('edit', $listing);

        return view('listings.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreListingFormRequest|Request $request
     * @param Area $area
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function update(StoreListingFormRequest $request, Area $area, Listing $listing)
    {
        //check if authorized
        $this->authorize('edit', $listing);

        //catch input
        $listing->title = $request->input('title');
        $listing->body = $request->input('body');
        $listing->area_id = $request->input('area');

        if (!$listing->live()) { //allowed changes if not live
            $listing->category_id = $request->input('category');
        }

        //save
        if ($listing->save()) {

            //save with payment button
            if ($request->has('payment')) {
                return redirect()->route('listings.payment.create', [$area, $listing]);
            }

            //default save
            return back()
                ->withSuccess('Listing updated successfully.');
        }

        //error
        return back()->withInput()->withError('Listing update error. Please try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Area $area
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area, $listing)
    {

        //listing
        $listing = Listing::onlyTrashed()->findOrFail($listing);

        //authorize
        $this->authorize('delete', $listing);

        //delete
        if($listing->forceDelete()){
            return back()->withSuccess('Listing deleted successfully.');
        }

        //error
        return back()->withError('Failed deleting listing. Please try again!');
    }
}
