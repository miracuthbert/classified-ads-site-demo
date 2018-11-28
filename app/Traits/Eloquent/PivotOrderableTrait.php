<?php

namespace App\Traits\Eloquent;


trait PivotOrderableTrait
{

    /**
     * Order model results by pivot
     *
     * @param $query
     * @param string $column
     * @param string $order
     * @return mixed
     */
    public function scopeOrderByPivot($query, $column = 'created_at', $order = 'desc')
    {
        return $query->orderBy('pivot_' . $column, $order);
    }
}