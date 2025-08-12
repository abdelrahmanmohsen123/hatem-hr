<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\ContactResource;

class ContactController extends Controller
{
    //
    use ApiResponder;
    public function getSocialContact()
    {

        $setting = Setting::first();

        return $this->respondResource(new ContactResource($setting));

    }
       
}
