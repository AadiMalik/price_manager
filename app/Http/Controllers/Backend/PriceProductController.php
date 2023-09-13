<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\PriceCategory;
use App\PriceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = PriceProduct::with('category_name')->get();

        return view('Backend.price_product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = PriceCategory::orderBy('name', 'ASC')->get();
        return view('Backend.price_product.create', compact('category'));
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
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            foreach ($request->name as $index => $item) {
                $product = new PriceProduct;
                $product->name = $item;
                $product->category_id = $request->category_id[$index];
                $product->user_id = Auth()->user()->id;
                $product->save();
            }

            return redirect()->route('price-product')->with('success', 'Products added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function show(PriceProduct $priceProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceProduct $product)
    {
        $category = PriceCategory::orderBy('name', 'ASC')->get();
        return view('Backend.price_product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceProduct $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->user_id = Auth()->user()->id;
            $product->save();
        }
        return redirect()->route('price-product')->with('success', 'Product update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceProduct $priceProduct)
    {
        //
    }
}
