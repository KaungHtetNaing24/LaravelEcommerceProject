<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $orders = Order::where('user_id',Auth::id())->get();
        return view('client.orders.index',compact('orders','categories'));
    }

    public function view($id)
    {
        $categories = Category::all();
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('client.orders.view',compact('orders','categories'));
    }
}
