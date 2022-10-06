<?php

namespace App\Http\Controllers\Backend;

use App\BuyPackage;
use App\Discount;
use App\Fpackage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FbuypackageController extends Controller
{
    public function buyPackage(Fpackage $package) {
        return view('Backend.f_buypackage.buyPackage',compact('package'));
    }

    public function storeBuyPackage(Request $request,Fpackage $package) {
        $validator = Validator::make($request->all(), [
            'voucher_number' => 'nullable|exists:discounts,voucher_code',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $buyPackage = new BuyPackage;
            $buyPackage->package_id = $package->id;
            if(auth()->user()->user_package!=null){
            $buyPackage->pre_package = auth()->user()->f_package_id;
            }
            if(auth()->user()->expiry_date!=null){
            $buyPackage->pre_expiry = auth()->user()->f_expiry;
            }
            if(auth()->user()->validity_day!=null){
            $buyPackage->pre_days = auth()->user()->f_days;
            }
                $fdate= date('Y-m-d');
                $tdate=auth()->user()->f_expiry;
                $datetime1 = new \DateTime($fdate);
                $datetime2 = new \DateTime($tdate);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');
                $newDate = now()->addDays($package->days + $days);
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
            \LogActivity::addToLog("Add Feature Package NO is {$buyPackage->f_package_id}");
            return redirect()->route('f_generateInvoice',[$package->id,$discount]);
        }
    }
}
