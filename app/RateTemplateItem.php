<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateTemplateItem extends Model
{
  protected $table = 'rate_template_item';

  // protected $fillable = ['id', 'name', "price", "label", "rate_template_item_id"];
  protected $guarded = [];
}
