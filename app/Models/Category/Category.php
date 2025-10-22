<?php

namespace App\Models\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $fillable = ['title','status'];

    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }
}
