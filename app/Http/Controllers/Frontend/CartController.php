<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        return view('Frontend/cart',compact('cart'));
    }

    public function remove($id){
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }

    public function checkout(Request $request){
        foreach($request->product_id as $index=>$item){
            $cart_update = Cart::where('user_id',Auth()->user()->id)->where('product_id',$item)->first();
            $cart_update->qty = $request->qty[$index];
            $cart_update->update();
        }
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        return view('frontend/checkout',compact('cart'));
    }

    public function store(Request $request){
        $validation = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|max:191',
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'payment_method' => 'required'
            ]
        );
        $sub_total = 0;
        $tax =0 ;
        $total = 0;
        $qty = 0;
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        foreach($cart as $item){
            $qty += $item->qty;
            $sub_total += $item->qty * $item->product_name->price;
            $tax += $sub_total * 0.17;
            $total += $sub_total + $tax + 200;
        }
        if($cart->count()>0){
            $order = new Order;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->payment_method = $request->payment_method;
            $order->order_no = 'Order'.random_int(1,99999);
            $order->shipping_charge = 200;
            $order->qty = $qty;
            $order->sub_total = $sub_total;
            $order->tax = $tax;
            $order->total = $total;
            $order->user_id = Auth()->user()->id;
            $order->save();
            foreach($cart as $item){
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $item->product_id;
                $order_detail->user_id = Auth()->user()->id;
                $order_detail->qty = $item->qty;
                $order_detail->price = $item->product_name->price;
                $order_detail->total = $item->qty * $item->product_name->price;
                $order_detail->save();
            }
            Cart::where('user_id',Auth()->user()->id)->delete();
            return redirect('/fhome');
        }else{
            return back()->with('error','Please select product first!');
        }
    }
}
