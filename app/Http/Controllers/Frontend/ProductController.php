<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Comment;
use App\EProduct;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show($id){
        $product = EProduct::find($id);
        $new = EProduct::orderBy('created_at','DESC')->get();
        $comment = Comment::orderBy('created_at','DESC')->where('product_id',$id)->where('status',0)->get();
        return view('Frontend/product_detail',compact('product','new','comment'));
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
    public function comment(Request $request){
        $validator = Validator::make($request->all(), [
            'rate' => 'required',
            'description' => 'required',
        ]);
        $comment = new Comment;
        $comment->rate = $request->rate;
        $comment->product_id = $request->product_id;
        $comment->user_id = Auth()->user()->id;
        $comment->description = $request->description;
        $comment->save();
        return back()->with('success','Thanks you for your reviews!');
    }
}
