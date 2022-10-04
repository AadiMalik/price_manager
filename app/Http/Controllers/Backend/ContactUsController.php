<?php

namespace App\Http\Controllers\Backend;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ContactUs as ContactUsJob;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = ContactUs::all();
        return view('Backend.contact-us.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function destroy(ContactUs $contact)
    {
        $contact->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Contact deleted successfully'
        ]);
    }
    
    public function replyContactUs(ContactUs $contact)
    {
        return view('Backend.contact-us.reply',compact('contact'));
    }
    
    public function sendContactUs(ContactUs $contact, Request $request) {
    
        $data = [
            'clientSubject' => $contact->message,
            'email' => $contact->email,
            'adminMessage' => $request->message,
            ];
            
        $job = ContactUsJob::dispatch($data);
        $data = [
            'reply_status' => true
            ];
        $contact->fill($data);
        $contact->save();
        return redirect()->route('indexContactUsAdmin');
    }
}
