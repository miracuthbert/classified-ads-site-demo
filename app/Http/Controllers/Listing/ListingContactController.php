<?php

namespace App\Http\Controllers\Listing;

use App\Http\Requests\StoreListingContactFormRequest;
use App\Mail\ListingContactCreated;
use App\Models\Area;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ListingContactController extends Controller
{
    /**
     * ListingContactController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    /**
     * Store a newly created resource.
     *
     * @param StoreListingContactFormRequest|Request $request
     * @param Area $area
     * @param Listing $listing
     */
    public function store(StoreListingContactFormRequest $request, Area $area, Listing $listing)
    {

        Mail::to($listing->user)->queue(

            new ListingContactCreated($listing, $request->user(), $request->message)
        );

        return back()->withSuccess("We have sent your message to {$listing->user->first_name} {$listing->user->last_name}");
    }
}
