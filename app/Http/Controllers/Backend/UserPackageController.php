<?php

namespace App\Http\Controllers\Backend;

use App\BuyPackage;
use App\Discount;
use App\Http\Controllers\Controller;
use App\UserPackage;
use Illuminate\Http\Request;
use Validator;

class UserPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userPackages = UserPackage::all();

        return view('Backend.userPackage.index',compact('userPackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.userPackage.create');
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
            'price' => 'required|numeric',
            'description' => 'required',
            'feature.*' => 'required',
            'validity_day' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'feature' => serialize($request->feature),
                'validity_day' => $request->validity_day,
            ];
            
            \LogActivity::addToLog("Package Create");
            $userPackage = UserPackage::create($data);

            return redirect()->route('indexUserPackage')->with('success', 'User package added successfully');
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
    public function edit(UserPackage $package)
    {
        return view('Backend.userPackage.edit',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPackage $package)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'feature.*' => 'required',
            'validity_day' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'feature' => serialize($request->feature),
                'validity_day' => $request->validity_day,
            ];
            
            \LogActivity::addToLog("Package Update id: {$package->id}");
            $package->update($data);

            return redirect()->route('indexUserPackage')->with('success', 'User package updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPackage $package)
    {
        $package->delete();

        return response()->json([
            'status' => 1,
            'message' => 'User Package deleted successfully'
        ]);
    }

    public function buyPackage(UserPackage $package) {
        return view('Backend.userPackage.buyPackage',compact('package'));
    }

    public function storeBuyPackage(Request $request,UserPackage $package) {
        $validator = Validator::make($request->all(), [
            'voucher_number' => 'nullable|exists:discounts,voucher_code',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $buyPackage = new BuyPackage;
            $buyPackage->package_id = $package->id;
            if(auth()->user()->user_package!=null){
            $buyPackage->pre_package = auth()->user()->user_package;
            }
            if(auth()->user()->expiry_date!=null){
            $buyPackage->pre_expiry = auth()->user()->expiry_date;
            }
            if(auth()->user()->validity_day!=null){
            $buyPackage->pre_days = auth()->user()->validity_day;
            }
                $fdate= date('Y-m-d');
                $tdate=$package->expiry_date;
                $datetime1 = new \DateTime($fdate);
                $datetime2 = new \DateTime($tdate);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');
                $newDate = now()->addDays($package->validity_day + $days);
                $buyPackage->expiry = $newDate;
            $buyPackage->status = 2;
            $buyPackage->user_id = auth()->user()->id;
            $discount = '';
            if ($request->voucher_number) {

                $discount = Discount::where('voucher_code', $request->voucher_number)->first();
                $discount->code_used = $discount->code_used + 1;
                
                $paidUserIds = explode(',',$discount->used_voucher_user_id);
                array_push($paidUserIds,auth()->user()->id);
                $changeInString = implode(',' ,$paidUserIds);
                $discount->used_voucher_user_id = str_replace('~[\\\\/:*?"<>|]~',',' ,$changeInString);
        
                $discount->save();
                $buyPackage->discount_id = $discount->id;
                $buyPackage->voucher_number = $request->voucher_number;
            }
            $buyPackage->save();
            \LogActivity::addToLog("Add Package NO is {$buyPackage->package_id}");
            return redirect()->route('generateInvoice',[$package->id,$discount]);
        }
    }
    
    
}
