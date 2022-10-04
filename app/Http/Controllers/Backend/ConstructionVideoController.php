<?php

namespace App\Http\Controllers\Backend;

use App\ConstructionVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ConstructionVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $constructionVideos = ConstructionVideo::all();

        return view('Backend.constructionVideo.index',compact('constructionVideos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.constructionVideo.create');
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
            'video_name' => 'required',
            'description' => 'required',
            'video_url' => 'required|url',
            'order_by' => 'required|unique:construction_videos,order_by',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $constructionVideo = new ConstructionVideo;
            $constructionVideo->video_name = $request->video_name;
            $constructionVideo->description = $request->description;
            $constructionVideo->video_url = $request->video_url;
            $constructionVideo->order_by = $request->order_by;

            $constructionVideo->save();

            return redirect()->route('indexConstructionVideo')->with('success', 'Construction Video added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConstructionVideo  $constructionVideo
     * @return \Illuminate\Http\Response
     */
    public function show(ConstructionVideo $constructionVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConstructionVideo  $constructionVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(ConstructionVideo $constructionVideo)
    {
        return view('Backend.constructionVideo.edit',compact('constructionVideo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConstructionVideo  $constructionVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConstructionVideo $constructionVideo)
    {
        $orderByValidation = 'required|unique:construction_videos,order_by';

        if ($request->order_by == $constructionVideo->order_by) {
            $orderByValidation = '';
        }
        $validator = Validator::make($request->all(), [
            'video_name' => 'required',
            'description' => 'required',
            'video_url' => 'required|url',
            'order_by' => $orderByValidation,
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $constructionVideo->video_name = $request->video_name;
            $constructionVideo->description = $request->description;
            $constructionVideo->video_url = $request->video_url;
            $constructionVideo->order_by = $request->order_by;

            $constructionVideo->save();

            return redirect()->route('indexConstructionVideo')->with('success', 'Construction Video update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConstructionVideo  $constructionVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConstructionVideo $constructionVideo)
    {
        $constructionVideo->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Construction Video deleted successfully'
        ]);
    }
}
