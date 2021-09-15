<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'desc')->take(10)->get();
        $cateprod = Product::orderBy('created_at', 'desc')->get();
        $popular_products = Product::where('popular','1')->orderBy('created_at', 'desc')->take(10)->get();
        return view('client.dashboard',compact('popular_products','products','categories','cateprod'));
    }

    public function viewcategory($slug)
    {
        if(Category::where('slug', $slug)->exists())
        {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('category_id',$category->id)->get();
            $categories = Category::all();
            return view('client.products.index', compact('category','products','categories'));
        }
        else
        {
            return redirect('/')->with('status',"Slug doesn't exists");
        }
    }
    
    public function productview($cate_slug, $prod_slug)
    {
        if(Category::where('slug', $cate_slug)->exists())
        {
            if(Product::where('slug', $prod_slug)->exists())
            {
                $product = Product::where('slug', $prod_slug)->first();
                $categories = Category::all();
                return view('client.products.view', compact('product','categories'));
            }
            else
            {
                return redirect('/')->with('status',"the link was broken");
            }
        }
        else
        {
            return redirect('/')->with('status',"No category found");
        }
    }

    public function searchProduct()
    {
        $categories = Category::all();
        $prod = Product::all();
        $search_product = request()->query('search');
        if($search_product){
            $products = Product::where('name','LIKE',"%{$search_product}%")->with('category')->simplePaginate(8);
        }else{
            $products = Product::simplePaginate(3);
        }
        return view('client.products.search',compact('products','categories'));
    }

    public function popularProducts()
    {
        $categories = Category::all();
        $popular_products = Product::where('popular','1')->orderBy('created_at', 'desc')->get();
        return view('client.products.popular',compact('popular_products','categories'));
    }

    public function allProducts()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('client.products.viewall',compact('products','categories'));
    }
}


