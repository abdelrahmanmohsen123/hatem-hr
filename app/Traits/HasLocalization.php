<?php

namespace App\Traits;


trait HasLocalization
{
    public function getNameAttribute()
    {
        return $this->{'name_' . app()->getLocale()};
    }
    public function getShortDescAttribute()
    {
        return $this->{'short_desc_' . app()->getLocale()};
    }
    public function getLongDescAttribute()
    {
        return $this->{'long_desc_' . app()->getLocale()};
    }

    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }
    public function getBodyAttribute()
    {
        return $this->{'body_' . app()->getLocale()};
    }

}
