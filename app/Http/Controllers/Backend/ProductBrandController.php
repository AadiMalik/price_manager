<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ProductBrand;
use Illuminate\Http\Request;
use Validator;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = ProductBrand::orderBy('name','ASC')->get();

        return view('Backend.product_brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.product_brand.create');
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
            
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'name' => $request->name,
                
            ];

            $brand = ProductBrand::create($data);

            return redirect()->route('productBrand')->with('success', 'Product brand added Successfully');
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
    public function edit(ProductBrand $brand)
    {
        return view('Backend.product_brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBrand $brand)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'name' => $request->name,
                
            ];

            
            $brand->update($data);

            return redirect()->route('productBrand')->with('success', 'Product Brand update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBrand $brand)
    {
        $brand->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Product brand deleted successfully'
        ]);
    }
}
