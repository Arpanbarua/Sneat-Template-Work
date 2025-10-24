<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Image\Image;
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

    // Image add

    public function productImageIndex()
    {
        $products = Product::select('id','title')->get();
        return view('backend.Product.image', compact('products'));
    }

    // Image Store

    public function productImageStore(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'product_id' => 'required',
        ]);

        // dd($request->all());

        
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $imguniquename = 'product-'.time(). Str::slug($image->getClientOriginalName()); 
                // dd($imguniquename);
                $image->storeAs('uploads/product/', $imguniquename, 'public');
                Image::create([
                    'image' => $imguniquename,
                    'product_id' => $request->product_id,
                ]);
            }
        }
   
        // $imagestore->save();
        Swal::success([
            'title' => 'Image(s) Added! ',
        ]);

        return redirect()->route('dashboard.product.image.show');
        
    }

    // image show
    public function productImageShow()
    {
        $images = Product::with('images')->simplePaginate(10);
        // dd($images);
        return view('backend.Product.imageview', compact('images'));
    }


}
