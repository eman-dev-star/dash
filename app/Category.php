<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Category extends Model implements TranslatableContract
{
	use Translatable;
	public $translatedAttributes = ['name'];
	protected $table='categories';
	protected $guarded=[];
	

	public function products(){
		return $this->hasMany(Product::class);
	}//end of products
      
}
