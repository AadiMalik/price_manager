<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\UserRating;
use Illuminate\Http\Request;
use Validator;

class UserRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRatings = UserRating::all();

        return view('Backend.userRating.index',compact('userRatings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.userRating.create');
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
            'rating_name' => 'required',
            'display_rating_name' => 'required',
            'description' => 'required',
            'order_number' => 'required|unique:user_ratings,order_number|integer',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $userRating = new UserRating;
            $userRating->rating_name = $request->rating_name;
            $userRating->display_rating_name = $request->display_rating_name;
            $userRating->description = $request->description;
            $userRating->order_number = $request->order_number;
            $userRating->save();

            return redirect()->route('indexUserRating')->with('success', 'User rating added successfully');
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
    public function edit(UserRating $userRating)
    {
        return view('Backend.userRating.edit',compact('userRating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRating $userRating)
    {
        $orderValidate = 'required|unique:user_ratings,order_number|integer';

        if($request->order_number == $userRating->order_number) {
            $orderValidate = '';
        }
        $validator = Validator::make($request->all(), [
            'rating_name' => 'required',
            'display_rating_name' => 'required',
            'description' => 'required',
            'order_number' => $orderValidate,
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $userRating->rating_name = $request->rating_name;
            $userRating->display_rating_name = $request->display_rating_name;
            $userRating->description = $request->description;
            $userRating->order_number = $request->order_number;
            $userRating->save();

            return redirect()->route('indexUserRating')->with('success', 'User rating updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRating $userRating)
    {
        $userRating->delete();

        return response()->json([
            'status' => 1,
            'message' => 'User rating deleted successfully'
        ]);
    }
}
