<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'movie_id',
        'user_id',
        'text'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
