<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'productdetails';
    public function star(){
      return $this->hasMany('App\Star');
    }

}
