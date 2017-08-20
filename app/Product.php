<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'size', 'color','category',
    ];

    protected $table = "products";

    /**
     * Get the orders for the product.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Get the users for the product.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
