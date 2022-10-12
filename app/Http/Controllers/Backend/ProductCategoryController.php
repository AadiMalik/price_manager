<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;
use Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = ProductCategory::orderBy('name','ASC')->get();

        return view('Backend.product_category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.product_category.create');
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

            $category = ProductCategory::create($data);

            return redirect()->route('productCategory')->with('success', 'Product Category added Successfully');
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
    public function edit(ProductCategory $category)
    {
        return view('Backend.product_category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $category)
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

            
            $category->update($data);

            return redirect()->route('productCategory')->with('success', 'Product Category update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Product Category deleted successfully'
        ]);
    }
}
