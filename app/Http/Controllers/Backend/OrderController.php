<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $order_detail = OrderDetail::all();
        if(Auth()->user()->id == 1){
            $order = Order::all();
        }else{
            $order = Order::where('user_id',Auth()->user()->id)->get();
        }
        return view('Backend/order.index',compact('order','order_detail'));
    }
}
