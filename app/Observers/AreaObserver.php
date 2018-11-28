<?php

namespace App\Observers;

use App\Models\Area;

class AreaObserver
{

    /**
     * Listen to the Area creating event.
     *
     * @param Area $area
     */
    public function creating(Area $area)
    {
        //generate area slug
        $prefix = $area->parent ? $area->parent->name . ' ' : '';
        $area->slug = str_slug($prefix . $area->name);

        //set child areas as usable
        $area->usable = $area->parent ? true : false;
    }
}