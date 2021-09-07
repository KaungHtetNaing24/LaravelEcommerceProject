<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isManagerOrStaff');
    }
    public function index(){
        $orders = Order::where('status','0')->orderBy('created_at', 'desc')->paginate(3);
        return view ('admin.index',compact('orders'));
    }
}
