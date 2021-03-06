<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status','0')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.orders.index',compact('orders'));
    }

    public function view($id)
    {
        $orders = Order::where('id', $id)->first();
        return view('admin.orders.view',compact('orders'));
    }

    public function updateOrder(Request $request,$id)
    {
        $orders = Order::find($id);
        $orders->status = $request->input('order_status');
        $orders->update();
        return redirect('admin/orders')->with('status',"Order updated successfully");
    }

    public function orderHistory()
    {
        $orders = Order::where('status','1')->paginate(5);
        return view('admin.orders.history',compact('orders'));
    }

    static function newOrder()
    {
        return Order::where('status','0')->count();
    }

    public function search(Request $request)
    {
        $search_order = request()->query('search');
        if($search_order){
            $orders = Order::where('order_no','LIKE',"%{$search_order}%")->simplePaginate(3);
        }else{
            $orders = Order::simplePaginate(3);
        }
        return view('admin.orders.search',compact('orders'));
    }
}
