<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
  protected $fillable =  [
    'parent_id', 'name',
  ];
  protected $table = 'subcat';

}
