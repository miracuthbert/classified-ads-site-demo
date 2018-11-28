<?php

namespace App\Http\Controllers\Listing;

use App\Models\Area;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingRestoreController extends Controller
{
    /**
     * ListingRestoreController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    function __invoke(Area $area, $listing)
    {
        //listing
        $listing = Listing::onlyTrashed()->findOrFail($listing);

        //authorize
        $this->authorize('delete', $listing);

        //delete
        if($listing->restore()){
            return back()->withSuccess('Listing restored successfully.');
        }

        //error
        return back()->withError('Failed restoring listing. Please try again!');
    }
}
