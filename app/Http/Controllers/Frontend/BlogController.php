<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blog = Blog::orderBy('created_at','DESC')->paginate(5);
        $otherblog = Blog::orderBy('created_at','ASC')->get();
        return view('Frontend/blog',compact('blog','otherblog'));
    }
    public function search(Request $request){
        $blog = Blog::orderBy('created_at','DESC')->where('title', 'LIKE', '%'.$request->search.'%')->paginate(5);
        $otherblog = Blog::orderBy('created_at','ASC')->get();
        return view('Frontend/blog',compact('blog','otherblog'));
    }
    public function blog_detail($slug){
        $blog = Blog::where('slug', $slug)->first();;
        $otherblog = Blog::orderBy('created_at','ASC')->get();
        // $comment = Comment::orderBy('created_at','DESC')->where('blog_id',$blog->id)->get();
        return view('Frontend/blog_detail',compact('blog','otherblog'));
    }
    // public function comment_store(Request $request,$id){
    //     $comment = new Comment;
    //     $comment->blog_id = $id;
    //     $comment->user_id = Auth()->user()->id;
    //     $comment->description = $request->comment;
    //     $comment->save();
    //     return redirect('blog-detail/'.$id);
    // }
}
