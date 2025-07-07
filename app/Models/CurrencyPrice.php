<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPrice extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyPriceFactory> */
    use HasFactory;
    protected $guarded = [];

     public function Base_currency()
    {
        return $this->belongsTo(Currency::class,'base_currency_id');
    }

     public function Target_currency()
    {
        return $this->belongsTo(Currency::class,'target_currency_id');
    }
}
