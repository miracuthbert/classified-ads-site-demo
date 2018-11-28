<?php

namespace App\Http\Controllers\Listing;

use App\Models\Area;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingPaymentController extends Controller
{
    /**
     * ListingPaymentController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Area $area
     * @param Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Area $area, Listing $listing)
    {
        //check if authorized
        $this->authorize('touch', $listing);

        //check if listing live
        if ($listing->live()) {
            return redirect()->route('listings.edit', [$area, $listing]);
        }

        return view('listings.payment.create', compact('listing'));
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
        //check if authorized
        $this->authorize('touch', $listing);

        //check if listing live
        if ($listing->live()) {
            return back();
        }

        //check if listing is free
        if ($listing->cost() === 0) {
            return back();
        }

        if ($request->has('pay_mpesa')) {
            return redirect()->route('listings.payment.mpesa', [$area, $listing]);
        }

        //set listing to live
        $listing->live = true;
        $listing->created_at = Carbon::now();
        $listing->save();

        return redirect()->route('listings.show', [$area, $listing])
            ->withSuccess('Congratulations! Payment accepted and your listing is live.');

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
     * @param Area $area
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area, Listing $listing)
    {

        //authorize
        $this->authorize('update', $listing);

        //check if listing is to be paid for
        if ($listing->cost() > 0) {
            return back();
        }

        //make listing live
        $listing->live = true;
        $listing->created_at = Carbon::now();

        if ($listing->save()) {
            return redirect()->route('listings.show', [$area, $listing])
                ->withSuccess('Congratulations! Your listing is live.');
        }

        //error
        return back()->withError('Failed completing transaction. Please try again.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
