<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BuyPackage;
use App\User;
use Validator;

class PackageHistoryController extends Controller
{
    public function index()
    {
        $packagehistory = BuyPackage::all();
        $userhistory = BuyPackage::all();
        return view('Backend.packageHistory.index',compact('packagehistory','userhistory'));
    }
    public function edit($id)
    {
        $packagehistory = BuyPackage::find($id);
        return view('Backend.packageHistory.edit',compact('packagehistory'));
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $packagehistory = BuyPackage::find($id);
            $user = User::where('id',$request->user_id)->first();
            $user->expiry_date=$packagehistory->pre_expiry;
            $user->user_package=$packagehistory->pre_package;
            $user->validity_day=$packagehistory->pre_days;
            $user->update();
            $packagehistory->status=1;
            $packagehistory->description=$request->description;
            $packagehistory->update_by=auth()->user()->id;
            $packagehistory->update();
            
            \LogActivity::addToLog("Delete Package id: {$packagehistory->id}");

            return redirect()->route('indexPackageHistory')->with('success', 'User package Deleted successfully');
        }
    }
}
