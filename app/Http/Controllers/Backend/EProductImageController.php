<?php

namespace App\Http\Controllers\Backend;

use App\EProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpg,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $product_image = new EProductImage;
            $product_image->product_id = $request->product_id;
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $upload = 'Images';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $product_image->image =  $upload . $filename;
            }
            $product_image->save();
            return back()->with('success','Product Image Saved!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EProductImage  $eProductImage
     * @return \Illuminate\Http\Response
     */
    public function show(EProductImage $eProductImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EProductImage  $eProductImage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_image = EProductImage::where('product_id',$id)->get();
        return view('Backend/e_product_image.index',compact('product_image','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EProductImage  $eProductImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EProductImage $eProductImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EProductImage  $eProductImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_image = EProductImage::find($id);
        $product_image->delete();
        return back()->with('success','Product Image Deleted!');
    }
}
