<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
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
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        //dd($request->all());

        $category = new Category();
        $category->title = $request->title;
        $category->status = $request->status;
        $category->parent_id = $request->category;
        $category->meta_title = $request->m_title;
        $category->meta_description = $request->m_desc;

        if($request->hasFile('m_img'))
        {
            $image = $request->file('m_img');
            $uniqueName = 'Category-'. time().'-'. $image->getClientOriginalName();
            $image->storeAs('category/', $uniqueName, 'public');
            $category->image = $uniqueName;

        }



        $category->save();

        Swal::success([
            'title' => 'Profile Added Successfully!',
        ]);

        return back();
        // dd($category);

    }

    // Show
    public function categoryShow()
    {
        $categories = Category::with('subCategories')->get();
        // dd($categories);
        return view('backend.category.show', compact('categories'));
    }


}


// 40:16