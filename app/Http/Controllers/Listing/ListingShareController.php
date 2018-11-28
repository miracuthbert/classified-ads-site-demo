<?php

namespace App\Http\Controllers\Listing;

use App\Http\Requests\StoreListingShareFormRequest;
use App\Mail\ListingShared;
use App\Models\Area;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ListingShareController extends Controller
{
    /**
     * ListingShareController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a share form.
     *
     * @param Area $area
     * @param Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function index(Area $area, Listing $listing)
    {
        return view('listings.share.show', compact('listing'));
    }

    /**
     * Store a newly created resource.
     *
     * @param StoreListingShareFormRequest|Request $request
     * @param Area $area
     * @param Listing $listing
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListingShareFormRequest $request, Area $area, Listing $listing)
    {
        collect(array_filter($request->emails))->each(function ($email) use ($request, $listing) {
            Mail::to($email)->queue(
                (
                new ListingShared($listing, $request->user(), $request->message)
                )->delay(Carbon::now()->addSeconds(10))
            );
        });

        return redirect()->route('listings.show', [$area, $listing])->withSuccess("Listing successfully shared.");
    }
}
