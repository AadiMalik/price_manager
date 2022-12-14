<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Comment;
use App\EProduct;
use App\EProductImage;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show($id){
        $product = EProduct::find($id);
        $product_image = EProductImage::where('product_id',$id)->get();
        $new = EProduct::orderBy('created_at','DESC')->get();
        $new_comment = Comment::orderBy('created_at','DESC')->where('status',0)->get();
        $comment = Comment::orderBy('created_at','DESC')->where('product_id',$id)->where('status',0)->get();
        return view('Frontend/product_detail',compact('product','product_image','new','comment','new_comment'));
    }
    public function index(){
        $product = EProduct::all();
        $comment = Comment::orderBy('created_at','DESC')->where('status',0)->get();
        $category = ProductCategory::orderBy('name','ASC')->get();
        return view('Frontend/products',compact('product','category','comment'));
    }
    public function category($id){
        $product = EProduct::where('category_id',$id)->get();
        $category = ProductCategory::orderBy('name','ASC')->get();
        $comment = Comment::orderBy('created_at','DESC')->where('status',0)->get();
        return view('Frontend/products',compact('product','category','comment'));
    }
    public function search(Request $request){
        $product = EProduct::where('name','LIKE','%'.$request->search.'%')->orWhere('price','LIKE','%'.$request->search.'%')->get();
        $category = ProductCategory::orderBy('name','ASC')->get();
        $comment = Comment::orderBy('created_at','DESC')->where('status',0)->get();
        return view('Frontend/products',compact('product','category','comment'));
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
