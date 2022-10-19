<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Http\Controllers\Controller;
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

    public function checkout(){
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        return view('frontend/checkout',compact('cart'));
    }
}
