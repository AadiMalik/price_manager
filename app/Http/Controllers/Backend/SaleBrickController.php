<?php

namespace App\Http\Controllers\Backend;

use App\SaleBrick;
use App\Customer;
use App\Product;
use App\User;
use App\Debit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class SaleBrickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = SaleBrick::with(['user_name','product_name','vender_name'])->orderBy('id','DESC')->get();
        return view('Backend.salebrick.index',compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // generate a pin based on 2 * 7 digits + a random character
        $pin = $characters[rand(0, strlen($characters) - 1)]. mt_rand(100, 999);
        // shuffle the result
        $bill_no = str_shuffle($pin);
        $customer = Customer::orderBy('name','ASC')->get();
        $users = User::orderBy('name','ASC')->where('id','!=','1')->where('id','!=','2')->get();
        $product = Product::where('user_id',75)->orderBy('name','ASC')->get();
        return view('Backend.salebrick.create',compact('customer','product','users','bill_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,SaleBrick  $saleBrick)
    {
        $product = Product::where('user_id',75)->orderBy('name','ASC')->get();
        $validator = Validator::make($request->all(), [
            'customer' => 'required',
            'vehicle' => 'required|min:1',
            'vendor' => 'required',
            'bill_no' => 'required',
        ]);
        $total =0;
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            foreach($product as $item){
                if($request['qty'.$item->id]!=null){
                    $total += $request['qty'.$item->id] * $request['rate'.$item->id];
                    SaleBrick::create([
                    'bill_no'       =>  $request->bill_no,
                    'code'       =>  $request->customer,
                    'vender_id'      =>  $request->vendor,
                    'vehicle'       =>  $request->vehicle,
                    'product_id'       =>  $item->id,
                    'qty'       =>  $request['qty'.$item->id],
                    'sale_rate'       =>  $request['rate'.$item->id],
                    'purchase_rate'       =>  $request['purchase_rate'.$item->id],
                    'user_id'           => Auth()->user()->id,
                  ]);
                }
            }
            $customer = Customer::where('code',$request->customer)->first();
            $customer->jamma = $customer->jamma-$total;
            $jamma = new Debit;
            $jamma->code = $request->customer;
            $jamma->banam = $total;
            $jamma->user_id = Auth()->user()->id;
            $jamma->save();
            $customer->update();
        }
        return redirect('generateinvoice/'.$request->bill_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleBrick  $saleBrick
     * @return \Illuminate\Http\Response
     */
    public function show($saleBrick)
    {
        $sale = SaleBrick::where('bill_no',$saleBrick)->orderBy('id','ASC')->get();
        $company = User::where('id',75)->get();
        $customer = Customer::all();
        return view('Backend.salebrick.invoice',compact('sale','company','customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleBrick  $saleBrick
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleBrick $saleBrick)
    {
        return view('Backend.salebrick.edit',compact('saleBrick'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleBrick  $saleBrick
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleBrick $saleBrick)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'description' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $saleBrick->status = $request->status;
            $saleBrick->description = $request->description;
            $saleBrick->user_id = Auth()->user()->id;
            if($request->status==1){
                $jamma = new Debit;
            $jamma->code = $saleBrick->code;
            $jamma->jamma = $saleBrick->sale_rate * $saleBrick->qty;
            $jamma->description = $request->description;
            $jamma->user_id = Auth()->user()->id;
            $jamma->save();
            }
            $saleBrick->update();
            return redirect()->route('indexSaleBricks')->with('success', 'Sale Bricks updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleBrick  $saleBrick
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleBrick $saleBrick)
    {
        //
    }
}
