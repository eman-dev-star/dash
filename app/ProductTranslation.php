<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
	protected $table='product_translations';
     protected $fillable = ['name','desc'];
   public $timestamps = false;
}
