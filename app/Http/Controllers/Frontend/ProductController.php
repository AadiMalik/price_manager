<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\EProduct;
use App\Http\Controllers\Controller;
use App\ProductCategory;
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
        $category = ProductCategory::orderBy('name','ASC')->get();
        return view('Frontend/products',compact('product','category'));
    }
    public function category($id){
        $product = EProduct::where('category_id',$id)->get();
        $category = ProductCategory::orderBy('name','ASC')->get();
        return view('Frontend/products',compact('product','category'));
    }
}
