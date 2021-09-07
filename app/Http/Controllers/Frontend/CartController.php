<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //     public function __construct()
    // {
    //     $this->middleware('isNormalUser');
    // }

    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check = Product::where('id',$product_id)->first();

            if($prod_check)
            {
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['warn' => $prod_check->name." already exist in your cart"]);
                }
                else{
                    // $prod = $prod_check->quantity - $product_qty;
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_quantity= $product_qty;
                    // $prod_check->quantity = $prod;
                    // $prod_check->update();
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name." added to cart"]);
                    
                }
                
            }
        }
        else
        {
            return response()->json(['warn' => " Please Login to Continue..."]);
        }
    }

    public function viewCart()
    {
        $categories = Category::all();
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('client.cart',compact('cartitems','categories'));
        
    }

    public function deleteProduct(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            // $prod_check = Product::where('id',$prod_id)->first();
            
            if(Cart::where('product_id',$prod_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = Cart::where('product_id',$prod_id)->where('user_id', Auth::id())->first();
                // $cartQty = $cartItem->product_quantity;
                // $prod = $prod_check->quantity + $cartQty;
                // $prod_check->quantity = $prod;
                // $prod_check->update();
                $cartItem->delete();
                return response()->json(['status' => " Product removed successfully..."]);
            }
        }
        else
        {
            return response()->json(['status' => " Please Login to Continue..."]);
        }
    }

    public function updatecart(Request $request)
    {
        $product_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            // $prod_check = Product::where('id',$product_id)->first();
            if(Cart::where('product_id',$product_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('product_id',$product_id)->where('user_id', Auth::id())->first();
                // $prod = $prod_check->quantity + $cart->product_quantity;
                $cart->product_quantity = $product_qty;
                // $prod_check->quantity = $prod - $cart->product_quantity;
                $cart->update();
                // $prod_check->update();
                return response()->json(['status' => " Product quantity updated..."]);
            }

        }

    }

    static function cartItem()
    {
        return Cart::where('user_id', Auth::id())->count();
    }
}
