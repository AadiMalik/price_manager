<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{
    public function index(){
        $faq = Faq::orderBy('id','ASC')->get();

        return view('Frontend.faq',compact('faq'));
    }
}
