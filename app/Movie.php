<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'genre_id'
    ];

    public function genre() {
        return $this->belongsTo('App\Genre');
    }

    public function reactions() {
        return $this->hasMany('App\Reaction');
    }
}
