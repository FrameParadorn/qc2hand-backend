<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateTemplate extends Model
{
  protected $table = 'rate_template';

  protected $fillable = [
    'id', 
    'name', 
    "display_type", 
    "model_type_id", 
    "rate_template_item_id"
  ];
}
