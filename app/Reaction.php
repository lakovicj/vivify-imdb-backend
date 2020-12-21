<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = [
        'movie_id',
        'user_id',
        'type'
    ];
}
