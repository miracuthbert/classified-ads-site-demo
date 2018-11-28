<?php

namespace App\Http\Controllers\Admin\Listing;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ListingResetIndexController extends Controller
{

    /**
     * ListingResetIndexController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
    {
        if (Gate::allows('admin-listings-update')) {

            $listings = Listing::all();
            $listings->unsearchable();

            return back()->withSuccess('Listings index reset successfully.');
        }

        return back()->withError('You have no permission to perform this action.');
    }
}
