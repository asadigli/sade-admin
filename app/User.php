<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public function posts(){
      return $this->hasMany('App\Post');
    }
    public function stars(){
      return $this->hasMany('App\Star');
    }
    public function comments(){
      return $this->hasMany('App\Comment');
    }
    public function message(){
      return $this->hasMany('App\Message');
    }
    public function likedPosts()
    {
        return $this->morphedByMany('App\Post', 'likeable')->whereDeletedAt(null);
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'surname',
        'gender',
        'country',
        'city',
        'dob',
        'mobile',
        'postalcode',
        'address',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is_admin(){
      if(($this->role_id)==4){
        return true;
      }elseif(($this->role_id)==3){
        return true;
      }elseif(($this->role_id)==2){
        return true;
      }
      return false;
    }
}
