<?php

namespace App\Http\Controllers\User;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{

    /**
     * Stores user's selected area
     *
     * @param Area $area
     */
    public function store(Area $area)
    {
        session()->put('area', $area->slug);

        //redirect to area category index
        return redirect()->route('categories.index', [$area]);
    }
}
