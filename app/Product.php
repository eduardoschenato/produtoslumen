<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function getUrlImageAttribute($value)
    {
        return app('url')->asset('uploads/products/' . $value);
    }

}
