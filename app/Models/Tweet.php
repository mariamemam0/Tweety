<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
