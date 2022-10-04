<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserPhone;

class UserPhoneController extends Controller
{
    public function index() {
        $users = UserPhone::orderBy('Created_at','DESC')->where('user_id',Auth()->user()->id)->get();

        return view('Backend/phone.index',compact('users'));

    }
}
