<?php

namespace App\Http\Controllers\Backend;

use App\EProduct;
use App\Http\Controllers\Controller;
use App\ProductBrand;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = EProduct::with(['category_name', 'brand_name'])->get();

        return view('Backend.e_product.index', compact('product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::orderBy('name', 'ASC')->get();
        $brand = ProductBrand::orderBy('name', 'ASC')->get();
        return view('Backend.e_product.create', compact('category', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'description' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'image1' => 'required|mimes:png,jpg,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $product = new EProduct;
            $product->name = ucwords($request->name);
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;
            $product->description = $request->description;
            if ($request->hasfile('image1')) {
                $file = $request->file('image1');
                $upload = 'Images';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $product->image1 =  $upload . $filename;
            }
            if ($request->hasfile('image2')) {
                $file = $request->file('image2');
                $upload = 'Images';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $product->image2 =  $upload . $filename;
            }
            if ($request->hasfile('image3')) {
                $file = $request->file('image3');
                $upload = 'Images';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $product->image3 =  $upload . $filename;
            }
            $product->save();
            return redirect()->route('e_roduct')->with('success', 'Product added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EProduct $product)
    {
        $category = ProductCategory::orderBy('name', 'ASC')->get();
        $brand = ProductBrand::orderBy('name', 'ASC')->get();
        return view('Backend.e_product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EProduct $product)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'description' => 'required',
            'category' => 'required',
            'brand' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $product->name = ucwords($request->name);
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;
            $product->description = $request->description;



            if ($request->hasfile('image1')) {
                $file = $request->file('image1');
                $upload = 'Images';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $product->image1 =  $upload . $filename;
            }
            if ($request->hasfile('image2')) {
                $file = $request->file('image2');
                $upload = 'Images';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $product->image2 =  $upload . $filename;
            }
            if ($request->hasfile('image3')) {
                $file = $request->file('image3');
                $upload = 'Images';
                $filename = time() . $file->getClientOriginalName();
                $path    = move_uploaded_file($file->getPathName(), $upload . $filename);
                $product->image3 =  $upload . $filename;
            }
            $product->update();

            return redirect()->route('e_product')->with('success', 'Product update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EProduct $product)
    {
        $product->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Product deleted successfully'
        ]);
    }
}
