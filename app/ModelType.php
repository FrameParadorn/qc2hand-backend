<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelType extends Model
{

  protected $table = 'model_type';

  protected $fillable = ['id', 'name', "image"];

}
