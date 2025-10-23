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

        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'is_stock' => 'required',
        ]);

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

        return redirect()->route('dashboard.product.show');

        // dd($request->all());
    }

    public function productShow()
    {
        $products = Product::latest()->simplePaginate(10);
        return view('backend.Product.show',compact('products'));
    }

    // product edit
    public function productEdit($id)
    {
        $categories = Category::select('id','title')->get();
        $product = Product::find($id);
        return view('backend.Product.edit', compact('product','categories'));
    }

     // product update
    public function productUpdate(Request $request, $id)
    {
         $request->validate([
            'title' => 'required',
            'price' => 'required',
            'is_stock' => 'required',
        ]);

        $product = Product::find($id);
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
            'title' => 'Product Updated Successfully!',
        ]);

        return redirect()->route('dashboard.product.show');
    }

    //product delete
    public function productDelete($id)
    {
        $product = Product::find($id)->delete();
         Swal::success([
            'title' => 'Product Deleted! ',
        ]);
        return redirect()->route('dashboard.product.show');
    }


}
