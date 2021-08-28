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
        $products = Product::take(10)->get();
        $popular_products = Product::where('popular','1')->take(10)->get();
        return view('client.dashboard',compact('popular_products','products','categories'));
    }
}
