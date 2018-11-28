<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Area extends Model
{
    use NodeTrait;

    protected $fillable = ['name', 'slug'];

    /**
     * Get the route key for the model.
     * Use 'slug' instead of id
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


}
