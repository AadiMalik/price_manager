<?php

namespace App\Http\Controllers\Frontend;

use App\EProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id){
        $product = EProduct::find($id);
        $new = EProduct::orderBy('created_at','DESC')->get();
        return view('Frontend/product_detail',compact('product','new'));
    }
    public function index(){
        $product = EProduct::all();
        return view('Frontend/products',compact('product'));
    }
}
