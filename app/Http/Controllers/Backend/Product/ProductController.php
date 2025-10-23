<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // index
    public function productIndex()
    {
        $categories = Category::get();
        return view('backend.Product.index', compact('categories'));
    }

    //store
    public function productStore(Request $request)
    {
    //     $validated = $request->validate([
    //         'description' => 'required',
    //         'features' => 'required',
    // // ... other fields
    //     ]);

        $product = new Product();
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->slug = 'product'. '-' . time() .Str::slug($request->title);
        $product->price = $request->price;
        $product->disc_price = $request->disc_price;
        $product->is_stock = $request->is_stock;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->features = $request->features;

        $product->save();

      

        Swal::success([
            'title' => 'Product Added Successfully!',
        ]);

        return back();

        // dd($request->all());
    }

    public function productShow()
    {
        $products = Product::latest()->simplePaginate(10);
        return view('backend.Product.show',compact('products'));
    }


}
