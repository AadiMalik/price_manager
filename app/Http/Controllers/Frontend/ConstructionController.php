<?php

namespace App\Http\Controllers\Frontend;

use App\ConstructionVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    public function showConstruction() {
        $constructionVideos = ConstructionVideo::all();

        return view('Frontend.construction',compact('constructionVideos'));

    }
}
