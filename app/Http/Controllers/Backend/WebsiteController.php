<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\WebSiteImage;
use Illuminate\Http\Request;
use Validator;
use Storage;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websiteImages = WebSiteImage::where('user_id', auth()->user()->id)->get();

        return view('Backend.websiteImage.index', compact('websiteImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.websiteImage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $website = new WebSiteImage;
            
            $image = $request->file('image');
            $upload = 'website/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $website->image_url = $upload.$filename;
                
//             $fileFolder = 'website';
// //
//             if (!Storage::exists($fileFolder)) {
//                 Storage::makeDirectory($fileFolder);
//             }

//             $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
//             $website->image_url = $imageUrl;
            $website->user_id = auth()->user()->id;
            $website->save();


            return redirect()->route('indexWebsite')->with('success', 'Image added successfully');
        }
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
    public function edit(WebSiteImage $website)
    {
        return view('Backend.websiteImage.edit',compact('website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebSiteImage $website)
    {
        if ($request->image) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg,jpg,png,gif',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            } else {
                if ($request->image) {
                    $image = $request->file('image');
            $upload = 'website/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $website->image_url = $upload.$filename;
                    $website->user_id = auth()->user()->id;
                    $website->save();
                }
            }
        }

        return redirect()->route('indexWebsite')->with('success', 'Image update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebSiteImage $website)
    {
        $website->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Website deleted successfully'
        ]);
    }
}
