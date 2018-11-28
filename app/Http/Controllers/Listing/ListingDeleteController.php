<?php

namespace App\Http\Controllers\Listing;

use App\Models\Area;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingDeleteController extends Controller
{

    /**
     * ListingDeleteController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Soft delete listing in storage.
     *
     * @param Area $area
     * @param Listing $listing
     * @return mixed
     */
    function __invoke(Area $area, Listing $listing)
    {
        //authorize
        $this->authorize('delete', $listing);

        //delete
        if($listing->delete()){
            return back()->withSuccess('Listing removed successfully. To delete or restore go to deleted listings.');
        }

        //error
        return back()->withError('Failed removing listing. Please try again!');
    }
}
