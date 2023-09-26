<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Controllers\Controller;
use App\PriceCategory;
use App\PriceProduct;
use App\PriceTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceTable = PriceTable::with(['city_name', 'category_name', 'product_name'])->orderBy('category_id', 'ASC')->orderBy('city_id', 'ASC')->get();

        return view('Backend.price_table.index', compact('priceTable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category_id = $request->category_id;
        $city_id = $request->city_id;
        $city = City::orderBy('name','ASC')->get();
        $category = PriceCategory::orderBy('name', 'ASC')->get();
        $products=[];
        if ($category_id!=null) {
            $product = PriceProduct::where('category_id', $category_id)->get();
            foreach($product as $item){
                $price = PriceTable::where('city_id',$city_id)->where('category_id', $category_id)->where('product_id',$item->id)->first();
                $products[]=[
                    "id"=>$item->id,
                    "name"=>$item->name,
                    "price"=>($price!=null)?$price->price:'0'
                ];
            }
            return view('Backend.price_table.create', compact('products','city','category','category_id','city_id'));
        }
        else{
            $products =[];
            return view('Backend.price_table.create', compact('products','city','category','category_id','city_id'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'city_id' => 'required',
            'product_id'=>'required',
            'price'=>'required',
            'max_price'=>'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            PriceTable::where('category_id',$request->category_id)->where('city_id',$request->city_id)->delete();
            foreach ($request->product_id as $index => $item) {
                $priceTable = new PriceTable;
                $priceTable->product_id = $item;
                $priceTable->price = $request->price[$index];
                $priceTable->max_price = $request->max_price[$index];
                $priceTable->category_id = $request->category_id;
                $priceTable->city_id = $request->city_id;
                $priceTable->user_id = Auth()->user()->id;
                $priceTable->save();
            }

            return redirect()->route('price-table')->with('success', 'Price Table added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PriceTable  $priceTable
     * @return \Illuminate\Http\Response
     */
    public function show(PriceTable $priceTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PriceTable  $priceTable
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceTable $priceTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PriceTable  $priceTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceTable $priceTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PriceTable  $priceTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceTable $priceTable)
    {
        //
    }
}
