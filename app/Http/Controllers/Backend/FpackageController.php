<?php

namespace App\Http\Controllers\Backend;

use App\Fpackage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FpackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $f_package = Fpackage::all();
        return view('Backend/f_package.index',compact('f_package'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend/f_package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate(
            [
                'name' => 'required|max:255',
                'price' => 'required|max:255',
                'days' => 'required|max:255',
                'description' => 'required|max:255',
                'icon' => 'required|max:255'
            ]
        );
        $package = new Fpackage;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->days = $request->days;
        $package->icon = $request->icon;
        $package->description = $request->description;
        $package->save();
        return redirect('f-package');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fpackage  $fpackage
     * @return \Illuminate\Http\Response
     */
    public function show(Fpackage $fpackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fpackage  $fpackage
     * @return \Illuminate\Http\Response
     */
    public function edit(Fpackage $f_package)
    {
        return view('Backend/f_package.edit',compact('f_package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fpackage  $fpackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate(
            [
                'name' => 'required|max:255',
                'price' => 'required|max:255',
                'days' => 'required|max:255',
                'description' => 'required|max:255',
                'icon' => 'required|max:255'
            ]
        );
        $package = Fpackage::find($id);
        $package->name = $request->name;
        $package->price = $request->price;
        $package->days = $request->days;
        $package->icon = $request->icon;
        $package->description = $request->description;
        $package->update();
        return redirect('f-package');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fpackage  $fpackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fpackage $fpackage)
    {
        //
    }
}
