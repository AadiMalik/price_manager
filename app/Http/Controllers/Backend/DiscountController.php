<?php

namespace App\Http\Controllers\Backend;

use App\Discount;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Validator;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->email == 'admin@gmail.com') {
            $discounts = Discount::all();

            return view('Backend.discount.index',compact('discounts'));

        }
        else {
            $discounts= Discount::where('user_id',auth()->user()->id)->get();
            return view('Backend.discount.index',compact('discounts'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('email','!=' ,'admin@gmail.com')->get();
        return view('Backend.discount.create',compact('users'));
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
            'voucher_code' => 'required|unique:discounts,voucher_code',
            'percentage' => 'required|numeric|gt:0',
            'expiry_date' => 'required|after:today',
            'user' => 'nullable|exists:users,id',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $discount = new Discount;
            $discount->voucher_code = $request->voucher_code;
            $discount->percentage = $request->percentage;
            $discount->expiry_date = $request->expiry_date;
            $discount->code_used = $request->code_used;

            if($request->user) {
                $discount->user_id = $request->user;
            }
            $discount->save();

            return redirect()->route('indexDiscount')->with('success', 'Discount added successfully');
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
    public function edit(Discount $discount)
    {
        $users = User::where('email','!=' ,'admin@gmail.com')->get();

        return view('Backend.discount.edit',compact('discount','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $voucherValidate = 'required|unique:discounts,voucher_code';
        $expiryDateValidate = 'required|after:today';

        if ($request->voucher_code == $discount->voucher_code) {
            $voucherValidate = 'nullable';
        }

        if ($request->expiry_date == $discount->expiry_date) {
            $expiryDateValidate = 'nullable';
        }

        $validator = Validator::make($request->all(), [
            'voucher_code' => $voucherValidate,
            'percentage' => 'required|numeric|gt:0',
            'expiry_date' => $expiryDateValidate,
            'user' => 'nullable|exists:users,id',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $discount->voucher_code = $request->voucher_code;
            $discount->percentage = $request->percentage;
            $discount->expiry_date = $request->expiry_date;
            $discount->code_used = $request->code_used;

            if($request->user) {
                $discount->user_id = $request->user;
            }
            $discount->save();

            return redirect()->route('indexDiscount')->with('success', 'Discount update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Discount deleted successfully'
        ]);
    }

    public function userDiscount () {
        $user = auth()->user();
        if ($user->email == 'admin@gmail.com') {
            $discounts = Discount::all();
        }else {
            $discounts =Discount::where('user_id',$user->id);
        }

        return view('Backend.discount.Index',compact('discounts'));
    }
    
    public function userName(Discount $discount){
        $user = auth()->user();
        $userIds = explode(',',$discount->used_voucher_user_id);
        // array_push($paidUserIds,auth()->user()->id);
        unset($userIds[0]);
        $array = array("Kyle","Ben","Sue","Phil","Ben","Mary","Sue","Ben");
// $counts = array_count_values($array);
// echo $counts['Kyle'];
        
        $users = User::whereIn('id',$userIds)->get();

        return view('Backend.discount.userName',compact('users','discount','userIds'));
    }
}
