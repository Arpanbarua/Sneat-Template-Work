<?php

namespace App\Models\Product;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //one product can have multiple images = hasmany
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
