<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPassword;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role_id', 'is_active', 'photo_id', '',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function likedPosts() {
        return $this->morphedByMany('App\Post', 'likeable')->whereDeletedAt(null);
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    // public function setPasswordAttribute($password) {
    //    if(!empty($password)){
    //      $this->attributes['password'] = bcrypt($password);
    //    }
    //    $this->attributes['password'] = $password;
    // }

    public function isAdmin() {
      if($this->role->name == 'Administrator' && $this->is_active == 1){
        return true;
      }
      return false;
    }

    public function posts() {
      return $this->hasMany('App\Post');
    }


}
