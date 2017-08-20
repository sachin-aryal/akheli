<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";


    /**
     * Get the product that owns the order.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /*
     * Get the user that owns the product
     * */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
