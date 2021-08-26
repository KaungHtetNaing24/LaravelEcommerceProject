<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.product.index',compact('products'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('admin.product.add',compact('categories'));
    }

    public function insert(Request $request)
    {
        
        
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',          
            'description' => 'required',
            'quantity' => 'required',
            'original_price' => 'required',
            'discount' => 'required',
            'final_price' => 'required',
            'image' => 'required',
            
        ]);
        $products = new Product();
        
        $products->category_id = $request->input('category_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->description = $request->input('description');
        $products->quantity = $request->input('quantity');
        $products->popular = $request->input('popular') == TRUE ? '1':'0';
        $products->original_price = $request->input('original_price');
        $products->discount = $request->input('discount');
        $products->final_price = $request->input('final_price');
        
        
        
        
        if($request->hasFile('image'))
        {
            $destination_path = 'public/images/product';
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $path = request()->file('image')->storeAs($destination_path,$products->name. '/' .$file_name);
            
            $products->image = $file_name;
        }else{
            return 'no file selected';
        }

        
        $products->save();
        return redirect('admin/products')->with('status',"Product add successfully");
    }



    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.product.edit',compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',          
            'description' => 'required',
            'quantity' => 'required',
            'original_price' => 'required',
            'discount' => 'required',
            'final_price' => 'required',
            
            
        ]);
        
        
        
        $products = Product::find($id);

        if($request->hasFile('image'))
        {
            $path = 'storage/images/product/'. $products->name . '/' . $products->image;
            if(File::exists($path))
            {
                File::delete($path);
            }

            $destination_path = 'public/images/product';
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            request()->file('image')->storeAs($destination_path,$products->name. '/' .$file_name);
            
            $products->image = $file_name;
        }
        
        $products->category_id = $request->input('category_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->description = $request->input('description');
        $products->quantity = $request->input('quantity');
        $products->popular = $request->input('popular') == TRUE ? '1':'0';
        $products->original_price = $request->input('original_price');
        $products->discount = $request->input('discount');
        $products->final_price = $request->input('final_price');
        $products->update();
        return redirect('admin/products')->with('status',"Product updated successfully");

    }

    public function destroy($id)
    {
        $products = Product::find($id);
        $path = 'storage/images/product/'.$products->name. '/' .$products->image;
            if(File::exists($path))
            {
                File::delete($path);
            }

            $products->delete();
            return redirect('admin/products')->with('status',"Product deleted successfully");
    }        
}

