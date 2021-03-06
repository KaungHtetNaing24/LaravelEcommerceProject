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
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
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
            'name' => 'required|unique:product,name',
            'slug' => 'required',          
            'description' => 'required',
            'quantity' => 'required',
            'original_price' => 'required',
            'discount' => 'required|integer|between:0,100',
            'final_price' => 'required',
            
            
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
        $products->save();
        
        
        
        if($request->hasFile('image'))
        {
            $destination_path = 'public/images/product';
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            request()->file('image')->storeAs($destination_path,$products->id. '/' .$file_name);
            $products->update(['image' => $file_name]);
        }

        
        
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
            'name' => 'required|unique:product,name,'.$id,
            'slug' => 'required',          
            'description' => 'required',
            'quantity' => 'required',
            'original_price' => 'required',
            'discount' => 'required|integer|between:0,100',
            'final_price' => 'required',
            
            
        ]);
        
        
        
        $products = Product::find($id);

        if($request->hasFile('image'))
        {
            $path = 'storage/images/product/'. $products->id . '/' . $products->image;
            if(File::exists($path))
            {
                File::delete($path);
            }

            $destination_path = 'public/images/product';
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            request()->file('image')->storeAs($destination_path,$products->id. '/' .$file_name);
            
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
        $path = 'storage/images/product/'.$products->id. '/' .$products->image;
            if(File::exists($path))
            {
                File::delete($path);
            }

            $products->delete();
            return redirect('admin/products')->with('status',"Product deleted successfully");
    }    
    
    static function productOutStock()
    {
        return Product::where('quantity','0')->count();
    }

    static function productItems()
    {
        return Product::where('quantity','>','0')->count();
    }

    public function search(Request $request)
    {
        $prod = Product::all();
        $search_product = request()->query('search');
        if($search_product){
            $products = Product::where('name','LIKE',"%{$search_product}%")->with('category')->simplePaginate(3);
        }else{
            $products = Product::simplePaginate(3);
        }
        return view('admin.product.search',compact('products'));
    }
}

