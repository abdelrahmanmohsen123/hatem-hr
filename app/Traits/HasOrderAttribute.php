<?php

namespace App\Traits;


trait HasOrderAttribute
{
    public function scopeIsOrder($query)
    {
     return $query->orderBy('order');

    }

}
