<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        if (!Auth::check()) {
            return $view;
        }

        $user = Auth::user();
        $listings = $user->listings;

        return $view->with([
            'deletedListingsCount' => $user->listings()->onlyTrashed()->count(),
            'unpublishedListingsCount' => $listings->where('live', false)->count(),
            'publishedListingsCount' => $listings->where('live', true)->count(),
        ]);
    }
}