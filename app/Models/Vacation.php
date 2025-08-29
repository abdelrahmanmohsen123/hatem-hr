<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable = ['starts_at', 'ends_at', 'reason', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
