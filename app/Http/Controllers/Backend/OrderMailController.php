<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class OrderMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderMails = OrderMail::all();

        return view('Backend.orderMail.index',compact('orderMails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.orderMail.create');
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
            'email' => 'required|email',
            'user_name' => 'required',
            'password' => 'required',
            'host' => 'required',
            'port' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $orderMail = new OrderMail;
            $orderMail->email = $request->email;
            $orderMail->user_name = $request->user_name;
            $orderMail->password = $request->password;
            $orderMail->host = $request->host;
            $orderMail->port = $request->port;

            $orderMail->save();

            return redirect()->route('indexOrderMail')->with('success', 'Order Mail added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderMail  $orderMail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderMail $orderMail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderMail  $orderMail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderMail $orderMail)
    {
        return view('Backend.orderMail.edit',compact('orderMail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderMail  $orderMail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderMail $orderMail)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'user_name' => 'required',
            'password' => 'required',
            'host' => 'required',
            'port' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $orderMail->email = $request->email;
            $orderMail->user_name = $request->user_name;
            $orderMail->password = $request->password;
            $orderMail->host = $request->host;
            $orderMail->port = $request->port;

            $orderMail->save();

            return redirect()->route('indexOrderMail')->with('success', 'Order Mail update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderMail  $orderMail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderMail $orderMail)
    {
        $orderMail->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Order Mail deleted Successfully'
        ]);
    }
}
