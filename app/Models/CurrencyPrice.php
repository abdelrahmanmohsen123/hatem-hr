<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPrice extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyPriceFactory> */
    use HasFactory;
    protected $guarded = [];
}
