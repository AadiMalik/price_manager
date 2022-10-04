<?php

namespace App\Http\Controllers\Frontend;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Jobs\ContactUs as ContactUsJob;

class ContactUsController extends Controller
{
    public function showContact () {

        return view('Frontend.contact');
    }

    public function storeContact (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $contact = new ContactUs;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            
            $contact->save();
            return redirect()->back()->with('success', 'Admin Contact you as soon as possible. Thanks');
        }
    }
}
