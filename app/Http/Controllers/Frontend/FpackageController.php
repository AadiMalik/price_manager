<?php

namespace App\Http\Controllers\Frontend;

use App\Fpackage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FpackageController extends Controller
{
    public function index()
    {
        $f_package = Fpackage::all();
        return view('Frontend/f_package',compact('f_package'));
    }
}
