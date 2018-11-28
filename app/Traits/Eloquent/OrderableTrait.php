<?php

namespace App\Traits\Eloquent;


trait OrderableTrait
{

    /**
     * Order model results by latest first
     *
     * @param $query
     * @return mixed
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    /**
     * Order model results by latest delete
     *
     * @param $query
     * @return mixed
     */
    public function scopeLatestDelete($query)
    {
        return $query->orderBy('deleted_at', 'DESC');
    }

}