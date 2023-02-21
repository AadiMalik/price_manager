<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::all();
        return view('Backend/blog.index', compact('blog'));
    }
    public function create()
    {
        return view('Backend/blog.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $blog = new Blog;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->slug = Str::slug($request->title);
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $upload = 'Images/';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $blog->image =  $upload . $filename;
            }
            $blog->save();
            return redirect('admin-blog')->with('success', 'Blog added Successfully');
        }
    }
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('Backend/blog.edit', compact('blog'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->slug = Str::slug($request->title);
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $upload = 'Images/';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $blog->image =  $upload . $filename;
            }
            $blog->update();
            return redirect('admin-blog')->with('success', 'Blog updated Successfully');
        }
    }
    public function destroy($id)
    {
    }
}
