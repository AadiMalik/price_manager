<?php

namespace App\Http\Controllers\Backend;

use App\Currier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currier = Currier::all();
        return view('Backend/currier.index',compact('currier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend/currier.create');
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
            $currier = new Currier;
            $currier->name = $request->name;
            $currier->phone = $request->phone;
            $currier->email = $request->email;
            $currier->address = $request->address;
            $currier->description = $request->description;
            $currier->save();
            return redirect()->route('currier')->with('success','Currier created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currier  $currier
     * @return \Illuminate\Http\Response
     */
    public function show(Currier $currier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currier  $currier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currier = Currier::find($id);
        return view('Backend/currier.edit',compact('currier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currier  $currier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currier $currier)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $currier->name = $request->name;
            $currier->phone = $request->phone;
            $currier->email = $request->email;
            $currier->address = $request->address;
            $currier->description = $request->description;
            $currier->update();
            return redirect()->route('currier')->with('success','Currier updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currier  $currier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currier $currier)
    {
        //
    }
}
