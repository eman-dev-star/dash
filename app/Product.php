<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use Astrotomic\Translatable\Translatable;

class Product extends Model  implements TranslatableContract
{
	use Translatable;
	protected $guarded=[];
	public $translatedAttributes = ['name','desc'];
	protected $table='products';
    protected $appends = ['image_path', 'profit_percent'];

    public function getImagePathAttribute(){
        return asset('uploads/products/'.$this->image);
    }
  
      public function getProfitPercentAttribute(){
        $profit=$this->sale_price - $this->purchase_price;
        $profit_percent=$profit*100/$this->purchase_price;
        return number_format($profit_percent, 2);
    }
    public function category(){
		return $this->belongsTo(Category::class);
	}//end of category
     public function orders(){
        return $this->belongsToMany(Order::class,'product_order');
    }//end of order
}
