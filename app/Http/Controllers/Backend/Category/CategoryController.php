<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //

    public function categoryIndex()
    {
        // dd('ok');
        $allCategory = Category::select('id','title')->get();
        //dd($allCategory);
        return view('backend.category.index', compact('allCategory'));
    }

    // store
    public function categoryStore(Request $request)
    {
        dd($request->all());
    }


}
