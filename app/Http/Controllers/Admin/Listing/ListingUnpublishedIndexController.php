<?php

namespace App\Http\Controllers\Admin\Listing;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ListingUnpublishedIndexController extends Controller
{

    /**
     * ListingUnpublishedIndexController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
    {
        if (Gate::allows('admin-listings-update')) {

            Listing::isNotLive()->unsearchable();

            return back()->withSuccess('Unpublished listings removed from index successfully.');
        }

        return back()->withError('You have no permission to perform this action.');
    }}
