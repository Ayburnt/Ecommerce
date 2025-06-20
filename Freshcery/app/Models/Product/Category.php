<?php

namespace App\Models\Product;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    

    protected  $table = "categories";
    protected $fillable = [

        "name", 
        "image", 
        "icon"
    ];

    public $timestamps = true;
}
