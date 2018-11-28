<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoriesComposer
{
    /**
     * Holds list of categories in storage.
     *
     * @var $categories
     */
    private $categories;

    public function compose(View $view)
    {
        if (!$this->categories) {
            $this->categories = Category::get()->toTree();
        }

        return $view->with('categories', $this->categories);
    }
}