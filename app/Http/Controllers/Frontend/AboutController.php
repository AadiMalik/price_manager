<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClientReview;

class AboutController extends Controller
{
    public function showAbout () {
        $reviews = ClientReview::all(); 
        return view('Frontend.about',compact('reviews'));
    }
}
