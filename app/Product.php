<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'size', 'color','category',
    ];

    protected $table = "products";

}
