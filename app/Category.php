<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =  [
      'name', 'created_at'
    ];
    protected $table ="category";

}
