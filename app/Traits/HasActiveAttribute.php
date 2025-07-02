<?php

namespace App\Traits;


trait HasActiveAttribute
{

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

}
