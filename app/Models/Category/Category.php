<?php

namespace App\Models\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
}
