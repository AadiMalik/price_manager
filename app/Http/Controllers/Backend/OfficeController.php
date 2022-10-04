<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Office;
use Illuminate\Http\Request;
use Validator;
use Storage;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::where('user_id', auth()->user()->id)->get();

        return view('Backend.office.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.office.create');
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
            'address' => 'required',
            'phone_no' => 'required|digits:11',
            'email' => 'required|email',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $office = new Office;
            if ($request->image) {
                $fileFolder = 'office';

                if (!Storage::exists($fileFolder)) {
                    Storage::makeDirectory($fileFolder);
                }

                $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
                $office->image_url = $imageUrl;
            }

            $office->user_id = auth()->user()->id;
            $office->name = $request->name;
            $office->address = $request->address;
            $office->phone_no = $request->phone_no;
            $office->email = $request->email;
            $office->description = $request->description;
            $office->save();

            return redirect()->route('indexOffice')->with('success', 'Office added successfully');
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
    public function edit(Office $office)
    {
        return view('Backend.office.edit',compact('office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone_no' => 'required|digits:11',
            'email' => 'required|email',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            if ($request->image) {
                $fileFolder = 'office';

                Storage::delete($office->image_url);

                if (!Storage::exists($fileFolder)) {
                    Storage::makeDirectory($fileFolder);
                }

                $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
                $office->image_url = $imageUrl;
            }

            $office->user_id = auth()->user()->id;
            $office->name = $request->name;
            $office->address = $request->address;
            $office->phone_no = $request->phone_no;
            $office->email = $request->email;
            $office->description = $request->description;
            $office->save();

            return redirect()->route('indexOffice')->with('success', 'Office update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Office deleted successfully'
        ]);
    }
}
