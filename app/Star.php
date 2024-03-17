<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
  protected $table="fivestar";
  public function user(){
    return $this->belongTo('App\User');
  }
  public function productdetails(){
    return $this->belongTo('App\ProductDetails');
  }
}
