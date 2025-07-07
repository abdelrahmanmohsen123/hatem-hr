<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BullionPrice extends Model
{
    /** @use HasFactory<\Database\Factories\BullionPriceFactory> */
    use HasFactory;
     protected $guarded = [];
       public function bullion()
    {
        return $this->belongsTo(Bullion::class,'bullion_id');
    }
}
