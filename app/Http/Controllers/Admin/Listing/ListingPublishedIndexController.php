<?php

namespace App\Http\Controllers\Admin\Listing;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ListingPublishedIndexController extends Controller
{

    /**
     * ListingPublishedIndexController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
    {
        if (Gate::allows('admin-listings-update')) {

            Listing::isLive()->searchable();

            return back()->withSuccess('Live listings indexed successfully.');
        }

        return back()->withError('You have no permission to perform this action.');
    }}
