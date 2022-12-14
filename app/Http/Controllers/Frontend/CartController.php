<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\City;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\PaymentMethod;
use App\Setting;
use App\ShippingAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth()->user()->id)->get();
        $setting = Setting::first();
        return view('Frontend/cart', compact('cart', 'setting'));
    }

    public function remove($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }
    public function coupon(Request $request)
    {
        $validation = $request->validate(
            [
                'code' => 'required|max:255'
            ]
        );
        $cart = Cart::where('user_id', Auth()->user()->id)->get();
        $coupon = Coupon::where('code', $request->code)->where('status', 0)->where('expiry', '>', Carbon::now()->format('Y-m-d H:i:s'))->first();
        if (isset($coupon)) {
            foreach ($cart as $item) {
                $item->coupon_id = $coupon->id;
                $item->update();
            }
            $msg = 'success';
            return $msg;
        } else {
            $msg = 'error';
            return $msg;
        }
    }
    public function checkout(Request $request)
    {
        foreach ($request->product_id as $index => $item) {
            $cart_update = Cart::where('user_id', Auth()->user()->id)->where('product_id', $item)->first();
            $cart_update->qty = $request->qty[$index];
            $cart_update->update();
        }
        $cart = Cart::where('user_id', Auth()->user()->id)->get();
        $shipping = ShippingAddress::where('user_id', Auth()->user()->id)->first();
        $city = City::orderBy('name', 'ASC')->get();
        $payment = PaymentMethod::all();
        $setting = Setting::first();
        return view('Frontend/checkout', compact('cart', 'shipping', 'city', 'payment', 'setting'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|max:191',
                'phone1' => 'required',
                'address' => 'required',
                'city' => 'required',
                'payment_method' => 'required'
            ]
        );
        $sub_total = 0;
        $tax = 0;
        $total = 0;
        $qty = 0;
        $cart = Cart::where('user_id', Auth()->user()->id)->get();
        $shipping = ShippingAddress::where('user_id', Auth()->user()->id)->first();
        $setting = Setting::first();
        if ($shipping != null) {
            $shipping->name = $request->name;
            $shipping->email = $request->email;
            $shipping->phone1 = $request->phone1;
            $shipping->phone2 = $request->phone2;
            $shipping->phone3 = $request->phone3;
            $shipping->address = $request->address;
            $shipping->city_id = $request->city;
            $shipping->update();
        } else {
            $save_shipping = new ShippingAddress;
            $save_shipping->name = $request->name;
            $save_shipping->email = $request->email;
            $save_shipping->phone1 = $request->phone1;
            $save_shipping->phone2 = $request->phone2;
            $save_shipping->phone3 = $request->phone3;
            $save_shipping->address = $request->address;
            $save_shipping->city_id = $request->city;
            $save_shipping->user_id = Auth()->user()->id;
            $save_shipping->save();
        }
        foreach ($cart as $item) {
            $qty += $item->qty;
            $sub_total += $item->qty * $item->product_name->price;
            $tax += $sub_total * ($setting->tax / 100);
            $total += $sub_total + $tax;
            $coupon_id = $item->coupon_id;
            $discount = $item->coupon_name->amount??'0';
        }
        $shipping = ($sub_total < $setting->shipping_limit) ? $setting->shipping_charge : '0';
        if ($cart->count() > 0) {
            $order = new Order;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone1 = $request->phone1;
            $order->phone2 = $request->phone2;
            $order->phone3 = $request->phone3;
            $order->address = $request->address;
            $order->city = $request->city;
            $order->payment_method = $request->payment_method;
            $order->order_no = 'Order' . random_int(1, 99999);
            $order->shipping_charge = $shipping;
            $order->qty = $qty;
            $order->coupon_id = $coupon_id;
            $order->discount = $discount??'0';
            $order->sub_total = $sub_total;
            $order->tax = $tax;
            $order->total = ($total + $shipping)-$discount;
            $order->user_id = Auth()->user()->id;
            $order->save();
            foreach ($cart as $item) {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $item->product_id;
                $order_detail->user_id = Auth()->user()->id;
                $order_detail->qty = $item->qty;
                $order_detail->price = $item->product_name->price;
                $order_detail->total = $item->qty * $item->product_name->price;
                $order_detail->save();
            }
            Cart::where('user_id', Auth()->user()->id)->delete();
            // Email order
            $details = [
                'name' => $request->name,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'phone3' => $request->phone3,
                'address' => $request->address,
                'city' => $request->city,
                'order_no' => 'Order' . random_int(1, 99999),
                'shipping_charge' => $shipping,
                'qty' => $qty,
                'discount' => $discount??'0',
                'sub_total' => $sub_total,
                'tax' => $tax,
                'total' => ($total + $shipping)-$discount
            ];
            \Mail::to(Auth()->user()->email)->send(new \App\Mail\Order($details));
            return redirect('/fhome');
        } else {
            return back()->with('error', 'Please select product first!');
        }
    }
}
