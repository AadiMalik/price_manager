<?php

namespace App\Http\Controllers\Backend;

use App\Currier;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order_detail = OrderDetail::all();
        if (Auth()->user()->id == 1) {
            $order = Order::all();
        } else {
            $order = Order::where('user_id', Auth()->user()->id)->get();
        }
        $currier = Currier::orderBy('name','ASC')->get();
        return view('Backend/order.index', compact('order', 'order_detail','currier'));
    }
    public function Status_Change(Request $request)
    {
        $check = Order::find($request->id);
        $check->status = $request->change;
        $check->update();
        return response()->json();
    }
    public function Currier(Request $request)
    {
        $check = Order::find($request->id);
        $check->currier_id = $request->currier_id;
        $check->update();
        return back();
    }
}
