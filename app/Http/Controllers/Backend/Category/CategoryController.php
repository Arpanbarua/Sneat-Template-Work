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
            'title' => 'Category Added Successfully!',
        ]);

        return redirect()->route('dashboard.category.show');
        // dd($category);

    }

    // Show
    public function categoryShow()
    {
        $categories = Category::with('parent')->latest()->get();
        // $subcategories = Category::with('parent')->get();
        //dd($subcategories);
        //dd($categories);
        return view('backend.category.show', compact('categories'));
    }

    // Edit
    public function categoryEdit($id)
    {
        $edit_category = Category::with('parent')->find($id);
        $allCategory = Category::with('parent')->select('id','title')->get();
        // dd($edit_category);
        return view('backend.category.edit',compact('edit_category','allCategory'));
    }

    // Update

    public function categoryUpdate(Request $request,$id)
    {
        $request->validate([
           'title' => 'required',
           'status' => 'required',
       ]);

        $update_category = Category::with('parent')->find($id);

        //dd($request->all());

        
        $update_category->title = $request->title;
        $update_category->status = $request->status;
        $update_category->parent_id = $request->category;
        $update_category->meta_title = $request->m_title;
        $update_category->meta_description = $request->m_desc;

        if($request->hasFile('m_img'))
        {
            $image = $request->file('m_img');
            $uniqueName = 'Category-'. time().'-'. $image->getClientOriginalName();
            $image->storeAs('category/', $uniqueName, 'public');
            $update_category->image = $uniqueName;

        }



        $update_category->save();

        Swal::success([
            'title' => 'Category Updated! ',
        ]);

        return redirect()->route('dashboard.category.show');
    }

    public function categoryDelete($id)
    {
        $category = Category::find($id)->delete();
        Swal::success([
            'title' => 'Category Deleted! ',
        ]);
        return back();
    }
   


}


// 17:33