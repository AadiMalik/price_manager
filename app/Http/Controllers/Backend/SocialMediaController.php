<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\SocialMedia;
use Illuminate\Http\Request;
use Validator;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialMedias = SocialMedia::all();

        return view('Backend.socialMedia.index',compact('socialMedias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.socialMedia.create');
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
            'name' => 'required|unique:social_media,name',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $socialMedia = new SocialMedia;
            $socialMedia->name = $request->name;
            \LogActivity::addToLog("Social Media Store");
            $socialMedia->save();

            return redirect()->route('indexSocialMedia')->with('success', 'Social Media added successfully');
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
    public function edit(SocialMedia $socialMedia)
    {
        return view('Backend.socialMedia.edit',compact('socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        $nameValidate = 'required|unique:social_media,name';
        if ($request->name == $socialMedia->name) {
            $nameValidate = 'nullable';
        }
        $validator = Validator::make($request->all(), [
            'name' => $nameValidate,
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $socialMedia->name = $request->name;
            \LogActivity::addToLog("Social Media Update id:{$socialMedia->id}");
            $socialMedia->save();

            return redirect()->route('indexSocialMedia')->with('success', 'Social Media update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialMedia)
    {
            \LogActivity::addToLog("Social Media Delete id:{$socialMedia->id}");
        $socialMedia->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Social Media deleted successfully'
        ]);
    }
}
