<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = User::where('brand_id',1)->get();

        return view('Backend.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.brand.create');
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
            'name' => 'required',
            'description' => 'required',
            'image_title' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'image_title' => $request->image_title,
            ];

            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'brandImage/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
            $data['image_url'] = $upload.$filename;;
            }
            $brand = Brand::create($data);

            return redirect()->route('indexBrand')->with('success', 'Brand added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('Backend.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $imageValidation = '';

        if ($request->image) {
            $imageValidation = 'required|mimes:png,jpg,jpeg,gif';
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image_title' => 'required',
            'image' => $imageValidation,
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'image_title' => $request->image_title,
            ];

            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'brandImage/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $data['image_url'] = $upload.$filename;;
            }
            $brand->update($data);

            return redirect()->route('indexBrand')->with('success', 'Brand update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Brand deleted successfully'
        ]);
    }
}
