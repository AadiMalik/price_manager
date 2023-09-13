<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\PriceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = PriceCategory::all();

        return view('Backend.price_category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.price_category.create');
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
            'qty' => 'required',
            'image' => 'required|max:4024',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $category = new PriceCategory;
            $category->name = $request->name;
            $category->qty = $request->qty;
            if ($request->hasfile('image')) {
                $image = $request->file('image');
                $upload = 'images/';
                $filename = time() . $image->getClientOriginalName();
                $path    = move_uploaded_file($image->getPathName(), $upload . $filename);
                $category->image = $upload . $filename;
            }
            $category->save();

            return redirect()->route('price-category')->with('success', 'Category added successfully');
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
    public function edit(PriceCategory $category)
    {
        return view('Backend.price_category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceCategory $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'qty' => 'required',
            'image' => 'required|max:4024',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $category->name = $request->name;
            $category->qty = $request->qty;
            if ($request->hasfile('image')) {
                $image = $request->file('image');
                $upload = 'images/';
                $filename = time() . $image->getClientOriginalName();
                $path    = move_uploaded_file($image->getPathName(), $upload . $filename);
                $category->image = $upload . $filename;
            }
            $category->save();

            return redirect()->route('price-category')->with('success', 'Category update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceCategory $category)
    {
        $category->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Category deleted successfully'
        ]);
    }
}
