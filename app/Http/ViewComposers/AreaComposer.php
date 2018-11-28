<?php

namespace App\Http\ViewComposers;

use App\Models\Area;
use Illuminate\View\View;

class AreaComposer
{
    private $area;

    public function compose(View $view)
    {
        if (!$this->area) {
            $this->area = Area::where('slug', session()->get('area', config()->get('homebid.defaults.area')))->first();
        }

        return $view->with('area', $this->area);
    }
}