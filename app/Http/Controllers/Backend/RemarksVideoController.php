<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\RemarksVideo;
use Illuminate\Http\Request;
use Validator;

class RemarksVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->id == 1) {
            $videoRemarks = RemarksVideo::all();
        } else {
        $videoRemarks = RemarksVideo::where('user_id',auth()->user()->id)->get();  
        }
        

        return view('Backend.videoRemarks.index',compact('videoRemarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.videoRemarks.create');
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
            'video_url' => 'required|url',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $videoRemarks = new RemarksVideo;
            $videoRemarks->video_url = $request->video_url;
            $videoRemarks->description = $request->description;
            $videoRemarks->user_id = auth()->user()->id;
            \LogActivity::addToLog("Remarks Video Store");
            $videoRemarks->save();

            return redirect()->route('indexVideoRemarks')->with('success', 'Video Remarks added successfully');
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
    public function edit(RemarksVideo $videoRemarks)
    {
        return view('Backend.videoRemarks.edit',compact('videoRemarks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RemarksVideo $videoRemarks)
    {
        $validator = Validator::make($request->all(), [
            'video_url' => 'required|url',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $videoRemarks->video_url = $request->video_url;
            $videoRemarks->description = $request->description;
            // $videoRemarks->user_id = auth()->user()->id;
            \LogActivity::addToLog("Remarks Video Update id:{$videoRemarks->id}");
            $videoRemarks->save();

            return redirect()->route('indexVideoRemarks')->with('success', 'Video Remarks update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RemarksVideo $videoRemarks)
    {
            \LogActivity::addToLog("Remarks Video Delete id:{$videoRemarks->id}");
        $videoRemarks->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Video Remarks deleted successfully'
        ]);
    }
}
