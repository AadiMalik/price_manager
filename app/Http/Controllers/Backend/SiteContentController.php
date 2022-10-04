<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\SiteContent;
use Illuminate\Http\Request;
use Validator;
use Storage;
use File;
class SiteContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteContents = SiteContent::all();

        return view('Backend.siteContent.index', compact('siteContents'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteContent $siteContent)
    {
        return view('Backend.siteContent.edit', compact('siteContent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteContent $siteContent)
    {
        
        if ($request->image) {
            $imageValidate = 'nullable|mimes:jpg,png,gif,jpeg';
            $contentValidate = 'nullable';
        }
        else {
            $imageValidate = 'nullable';
            $contentValidate = 'required';
        }
        $validator = Validator::make($request->all(), [
            'content' => $contentValidate,
            'image' => $imageValidate,
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'siteContent/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $siteContent->content = $upload.$filename;
            }
            
            $siteContent->content = $request->content ?? $siteContent->content;
            
            \LogActivity::addToLog("Website Content Update id:{$siteContent->id}");
            $siteContent->save();

            return redirect()->route('indexSiteContent')->with('success', 'Site Content update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // public function slider()
    // {
    //     $slider = SiteContent::all();

    //     return view('Backend.slider.index', compact('slider'));
    // }
    //  public function editslider($id)
    // {
    //     $slider = SiteContent::find($id);
    //     return view('Backend/slider.edit', compact('slider'));
    // }
    // public function updateslider(Request $request,$id)
    // {
        
    //     if ($request->image) {
    //         $imageValidate = 'nullable|mimes:jpg,png,gif,jpeg';
    //         $contentValidate = 'nullable';
    //     }
    //     else {
    //         $imageValidate = 'nullable';
    //         $contentValidate = 'required';
    //     }
    //     $validator = Validator::make($request->all(), [
            
    //         'image' => $imageValidate,
    //     ]);
    //     if ($validator->fails()) {
    //         return back()->withInput()->withErrors($validator);
    //     } else {
    //         if($request->hasfile('image')){
    //         $image = $request->file('image');
    //         $upload = 'siteContent/';
    //         $filename = time().$image->getClientOriginalName();
    //         $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
    //             $siteContent->content = $upload.$filename;
    //         }
            
            
    //         $siteContent->save();

    //         return redirect()->route('indexslider')->with('success', 'Site Content update successfully');
    //     }
    // }
}
