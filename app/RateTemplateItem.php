<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateTemplateItem extends Model
{
  protected $table = 'rate_template_item';

  protected $fillable = ['id', 'name', "price", "rate_template_item_id"];
}
