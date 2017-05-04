<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'timeline', 'description', 'category_id', 'photo_id',
    ];

    protected $attributes = array(
        'timeline' => '{}'
    );

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

}
