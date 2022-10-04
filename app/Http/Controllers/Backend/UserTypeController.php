<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\UserType;
use Illuminate\Http\Request;
use Validator;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userTypes = UserType::all();

        return view('Backend.userType.index',compact('userTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.userType.create');
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
            'name' => 'required|unique:user_types,name',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $userType = new UserType;
            $userType->name = $request->name;
            
            \LogActivity::addToLog("User Type Create");
            $userType->save();

            return redirect()->route('indexUserType')->with('success', 'User type added successfully');
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
    public function edit(UserType $userType)
    {
        return view('Backend.userType.edit',compact('userType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserType $userType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $userType->name = $request->name;
            
            \LogActivity::addToLog("User Type Update id: {$userType->id}");
            $userType->save();

            return redirect()->route('indexUserType')->with('success', 'User type updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType)
    {
            \LogActivity::addToLog("User Type Delete id: {$userType->id}");
        $userType->delete();

        return response()->json([
            'status' => 1,
            'message' => 'User type deleted successfully'
        ]);
    }
}
