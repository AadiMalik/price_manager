<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\RemarksImage;
use Illuminate\Http\Request;
use Validator;
use Storage;
use File;
class RemarksImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->id == 1) {
            $imageRemarks = RemarksImage::all();
        } else {
        $imageRemarks = RemarksImage::where('user_id',auth()->user()->id)->get();    
        }
        
        return view('Backend.imageRemarks.index',compact('imageRemarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.imageRemarks.create');
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
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $imageRemarks = new RemarksImage;
            
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'remarksImages/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $imageRemarks->image_url = $upload.$filename;
            }
            

            $imageRemarks->name = $request->name;
            $imageRemarks->user_id = auth()->user()->id;
            $imageRemarks->description = $request->description;
            \LogActivity::addToLog("Remarks Image Store");
            $imageRemarks->save();

            return redirect()->route('indexImageRemarks')->with('success', 'Remarks added successfully');
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
    public function edit(RemarksImage $imageRemarks)
    {
        return view('Backend.imageRemarks.edit',compact('imageRemarks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RemarksImage $imageRemarks)
    {
        $imageValidation = 'nullable';

        if ($request->has('image')) {
            $imageValidation = 'required|mimes:jpg,png,jpeg,gif';
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => $imageValidation,
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'remarksImages/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $imageRemarks->image_url = $upload.$filename;
            }

            $imageRemarks->name = $request->name;
            $imageRemarks->description = $request->description;
            \LogActivity::addToLog("Remarks Image Update id:{$imageRemarks->id}");
            $imageRemarks->save();

            return redirect()->route('indexImageRemarks')->with('success', 'Remarks update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RemarksImage $imageRemarks)
    {
        \LogActivity::addToLog("Remarks Image Delete id:{$imageRemarks->id}");
        $imageRemarks->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Remarks deleted successfully'
        ]);
    }
}
