<?php

namespace App\Http\ViewComposers;

use App\Models\Area;
use Illuminate\View\View;

class AreasComposer
{
    /**
     * Holds list of areas in storage.
     *
     * @var $areas
     */
    private $areas;

    public function compose(View $view)
    {
        if (!$this->areas) {
            $this->areas = Area::get()->toTree();
        }

        return $view->with('areas', $this->areas);
    }
}