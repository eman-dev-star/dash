<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }//end of orders
     public function products(){
        return $this->belongsToMany(Product::class,'product_order')->withPivot('quantity');
    }//end of order
     public function client()
    {
        return $this->belongsTo(Client::class);

    }//end of user
    
}
