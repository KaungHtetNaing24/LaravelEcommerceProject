<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartitems as $item)
        {
            if(!Product::where('id',$item->product_id)->where('quantity','>=',$item->product_quantity)->exists())
            {
                $removeItem = Cart::where('user_id',Auth::id())->where('product_id',$item->product_id)->first();
                $removeItem->delete();
            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('client.checkout',compact('categories','cartitems'));
    }

    public function placeorder(Request $request)
    {
        $request->validate([
            'address_detail' => 'required',
            'payment_method' => 'required',      
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->address_detail = $request->input('address_detail');
        $order->payment_method = $request->input('payment_method');
        
        $total = 0;
        $cartitems_total = Cart::where('user_id',Auth::id())->get();
        foreach($cartitems_total as $prod_total)
        {
            $total += $prod_total->products->final_price * $prod_total->product_quantity;
        }

        $order->total_price = $total;
        $order->order_no = '#autumn'.rand(1111,9999);
        $order->save();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        
        foreach($cartitems as $item)
        {
            OrderDetail::create([
                'order_id'=> $order->id,
                'product_id'=> $item->product_id,
                'quantity'=> $item->product_quantity,
                'price'=> $item->products->final_price,
            ]);

            $prod = Product::where('id',$item->product_id)->first();
            $prod->quantity = $prod->quantity - $item->product_quantity;
            $prod->update();
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartitems);
        return redirect('/')->with('status',"Order Successfully");
    }
}
