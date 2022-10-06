<?php

namespace App\Http\Controllers\Backend;

use App\Discount;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\User;
use App\UserPackage;
use App\BuyPackage;
use App\Fpackage;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $invoices = Invoice::latest('id')->get();
        return view('Backend.invoice.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserPackage $package, Discount $discount  = null,$status)
    {
        $discountPrice = 0;
        if ($discount) {
            $changeIntoFloat =  $discount->percentage / 100;
            $discountPrice = $package->price * $changeIntoFloat;
        }
        $invoice = new Invoice;
        $invoice->user_id = auth()->user()->id;
        $invoice->package_id = $package->id;
        $invoice->price = round($package->price - $discountPrice);
        $invoice->status = 0;
        $invoice->save();
        $user = auth()->user();
        return view('Backend.invoice.invoice',compact('package','discount','invoice','user'));
    }
    public function f_create(Fpackage $package, Discount $discount  = null,$status)
    {
        $discountPrice = 0;
        if ($discount) {
            $changeIntoFloat =  $discount->percentage / 100;
            $discountPrice = $package->price * $changeIntoFloat;
        }
        $invoice = new Invoice;
        $invoice->user_id = auth()->user()->id;
        $invoice->package_id = $package->id;
        $invoice->price = round($package->price - $discountPrice);
        $invoice->status = 0;
        $invoice->type =1;
        $invoice->save();
        $user = auth()->user();
        return view('Backend.invoice.invoice',compact('package','discount','invoice','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('Backend.invoice.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
    
        $invoice->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Invoice deleted successfully'
        ]);
    }

    public function statusChange(Invoice $invoice) {
        if($invoice->type==0){
        $newDate = date('Y-m-d', strtotime($invoice->user->expiry_date. ' + '.$invoice->package->validity_day.' days'));
        $invoice->user->update(['expiry_date'=>$newDate,'user_package'=>$invoice->package->id]);
        $invoice->status = 1;
        $invoice->save();
        }else{
            
            $newDate = date('Y-m-d', strtotime($invoice->user->f_expiry. ' + '.$invoice->f_package->days.' days'));
            $user = User::find($invoice->user->id);
            $user->f_expiry = $newDate;
            $user->f_package_id = $invoice->package_id;
            $user->f_days = $invoice->f_package->days;
            $user->update();
        // $invoice->user->update(['f_expiry'=>$newDate,'f_package_id'=>$invoice->f_package->id,'f_days'=>$invoice->f_package->days]);
        $invoice->status = 1;
        $invoice->save();
        }
                                                                                        // Data Store in By Package Table on Paid Status
        // $buyPackage = new BuyPackage;
        // $buyPackage->package_id = $invoice->package->id;
        // $newDate = date('Y-m-d', strtotime($invoice->package->validity_day.' days'));
        // $buyPackage->expiry = $newDate;
        // $buyPackage->status = 2;
        // $byPackage->description = 'Package Confirm by Admin';
        // $byPackage->save();
        return response()->json([
            'status' => 1,
            'message' => 'Status is updated'
        ]);
    }
    public function statusRejected(Invoice $invoice){
        $invoice->status = 2;
        $invoice->save();
                                                                                            // Data Store in By Package Table on Reject Status
        // $buyPackage = new BuyPackage;
        // $buyPackage->package_id = $invoice->package->id;
        // $newDate = date('Y-m-d', strtotime($invoice->package->validity_day.' days'));
        // $buyPackage->expiry = $newDate;
        // $buyPackage->status = 1;
        // $byPackage->description = 'Package Reject by Admin';
        // $byPackage->save();

        return response()->json([
            'status' => 1,
            'message' => 'Status is updated'
        ]);

    }
}
