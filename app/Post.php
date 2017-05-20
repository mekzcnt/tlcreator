<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{

    protected $json_columns = [
        'timeline'
    ];

    protected $fillable = [
        'title', 'timeline', 'description', 'category_id', 'photo_id',
    ];

    protected $casts = [
        'timeline' => 'json',
    ];

    public function likes() {
        return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute() {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

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
