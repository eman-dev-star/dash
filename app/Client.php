<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $casts = [
        'phone' => 'array'
    ];
    public function getNameAttribute($val){
    	return ucfirst($val);
    }
   public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders
}
