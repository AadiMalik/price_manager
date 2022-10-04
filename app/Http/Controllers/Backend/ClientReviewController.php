<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ClientReview;
use Illuminate\Http\Request;
use Validator;
use Storage;

class ClientReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews= ClientReview::all();

        return view('Backend.clientReview.index',compact('reviews'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.clientReview.create');

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
            'type' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $imageRemarks = new ClientReview();
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'remarksImages/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $imageRemarks->image_url = $upload.$filename;;
            }
            

            $imageRemarks->name = $request->name;
            $imageRemarks->type = $request->type;
            $imageRemarks->description = $request->description;
            $imageRemarks->save();

            return redirect()->route('indexReviews')->with('success', 'Remarks added successfully');
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
    public function edit(ClientReview $review)
    {
        return view('Backend.clientReview.edit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientReview $review)
    {
        $imageValidation = 'nullable';

        if ($request->has('image')) {
            $imageValidation = 'required|mimes:jpg,png,jpeg,gif';
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
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

            $review->name = $request->name;
            $review->type = $request->type;
            $review->description = $request->description;
            $review->save();

            return redirect()->route('indexReviews')->with('success', 'Remarks update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientReview $review)
    {
        $review->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Review deleted successfully'
        ]);
    }
}
