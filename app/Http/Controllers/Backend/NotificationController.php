<?php

namespace App\Http\Controllers\Backend;

use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Storage;
use File;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $notification = Notification::all();
        
        return view('Backend.notification.index',compact('notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $notification = new Notification;
            
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'notification/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $notification->image = $upload.$filename;
            }
            

            $notification->heading = $request->heading;
            $notification->user_id = auth()->user()->id;
            $notification->description = $request->description;
            $notification->save();
\LogActivity::addToLog("Notification Store");
            return redirect()->route('indexnotification')->with('success', 'Notification added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        return view('Backend.notification.edit',compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'notification/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $notification->image = $upload.$filename;
            }
            

            $notification->heading = $request->heading;
            $notification->user_id = auth()->user()->id;
            $notification->description = $request->description;
            $notification->update();
\LogActivity::addToLog("Notification Update id: {$notification->id}");
            return redirect()->route('indexnotification')->with('success', 'Notification updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        \LogActivity::addToLog("Notification Delete id:{$imageRemarks->id}");
        $notification->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Notification deleted successfully'
        ]);
    }
}
