<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\InvoiceImage;
use App\Invoice;
use Illuminate\Http\Request;
use Validator;
use Storage;
use File;
class InvoiceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->email == 'admin@gmail.com') {
            $invoiceImages = InvoiceImage::all();            
        }
        else {
            $invoiceImages = InvoiceImage::where('user_id', auth()->user()->id)->get();
        }


        return view('Backend.invoice-image.index',compact('invoiceImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = Invoice::where('user_id',auth()->user()->id)->where('status',0)->get();
        return view('Backend.invoice-image.create',compact('invoices'));

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
            'image' => 'required|mimes:jpg,png,jpeg,gif',
            'invoice_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $imageRemarks = new InvoiceImage;
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'invoiceImage/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $imageRemarks->image_url = $upload.$filename;
            }
            $imageRemarks->user_id = auth()->user()->id;
            $imageRemarks->invoice_id = $request->invoice_id;
            $user_id =auth()->user()->id;
            \LogActivity::addToLog("Invoice Image Store by {$user_id}");
            $imageRemarks->save();

            return redirect()->route('indexInvoiceImage')->with('success', 'Invoice added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceImage $invoice)
    {
        return view('Backend.invoice-image.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceImage $invoice)
    {
        $invoices = Invoice::where('user_id',auth()->user()->id)->get();
        return view('Backend.invoice-image.edit',compact('invoice','invoices'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceImage $invoice)
    {
        
        $imageValidation = 'nullable';

        if ($request->has('image')) {
            $imageValidation = 'required|mimes:jpg,png,jpeg,gif';
           
        }
        $validator = Validator::make($request->all(), [
            'image' => $imageValidation,
             'invoice_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'invoiceImage/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $imageRemarks->image_url = $upload.$filename;
            }
            $invoice->user_id = auth()->user()->id;
            
            $invoice->invoice_id = $request->invoice_id;
            $user_id =auth()->user()->id;
            \LogActivity::addToLog("Invoice Image Update by {$user_id} and invoice no {$request->invoice_id}");
            $invoice->save();

            return redirect()->route('indexInvoiceImage')->with('success', 'Invoice Image update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceImage $invoice)
    {
        
        if ($invoice->image_url) {
            if(File::exists('storage/app/public/'.$invoice->image_url)) {
                File::delete('storage/app/public/'.$invoice->image_url);
            }
            //Storage::delete($invoice->image_url);
        }
        $updateinvoice = Invoice::where('id','=',$invoice->invoice_id)->first();
        $updateinvoice->status = 0;
        $updateinvoice->save();
        $user_id =auth()->user()->id;
        \LogActivity::addToLog("Invoice Image Delete by {$user_id} and invoice no {$invoice->invoice_id}");
        $invoice->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Invoice Image deleted successfully'
        ]);
    }
}
