<?php

namespace App\Http\Controllers\Backend;

use App\Customer;
use App\Location;
use App\User;
use App\Debit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();

        return view('Backend.customer.index',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = Location::orderBy('location','ASC')->get();
        return view('Backend.customer.create',compact('location'));
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
            'code' => 'required|min:1|unique:customers,code',
            'name' => 'required|min:1|max:255',
            'location' => 'required',
            'jamma' => 'required|min:1',
            'phone' => 'required|min:1|unique:customers,phone',
            'description' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->code = $request->code;
            $customer->location_id = $request->location;
            $customer->jamma = $request->jamma;
            $customer->phone = $request->phone;
            $customer->description = $request->description;
            $customer->user_id = Auth()->user()->id;
            
            $jamma = new Debit;
            $jamma->code = $request->code;
            $jamma->jamma = $request->jamma;
            $jamma->user_id = Auth()->user()->id;
            
            $customer->save();
            $jamma->save();

            return redirect()->route('indexCustomer')->with('success', 'Customer added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $location = Location::orderBy('location','ASC')->get();
        return view('Backend.customer.edit',compact('customer','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:255',
            'location' => 'required',
            'jamma' => 'required|min:1',
            'phone' => 'required|min:1|unique:customers,phone',
            'description' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $customer->name = $request->name;
            $customer->location_id = $request->location;
            
            $customer->phone = $request->phone;
            $customer->description = $request->description;
            $customer->user_id = Auth()->user()->id;
            if($request->plus!=null){
                $customer->jamma = $customer->jamma+$request->plus;
                $jamma = new Debit;
                $jamma->code = $request->code;
                $jamma->jamma = $request->plus;
                $jamma->user_id = Auth()->user()->id;
                $jamma->save();
            }else{
                $customer->jamma = $customer->jamma-$request->subtract;
                $jamma = new Debit;
                $jamma->code = $request->code;
                $jamma->banam = $request->subtract;
                $jamma->user_id = Auth()->user()->id;
                $jamma->save();
            }
            
            $customer->update();

            return redirect()->route('indexCustomer')->with('success', 'Customer updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
    public function invoice($id)
    {
        $company = User::where('id',75)->get();
        $customer = Customer::find($id);
        return view('Backend.customer.invoice',compact('company','customer'));
    }
}
