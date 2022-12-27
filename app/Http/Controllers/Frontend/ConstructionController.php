<?php

namespace App\Http\Controllers\Frontend;

use App\ConstructionCategory;
use App\ConstructionVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    public function showConstruction() {
        $category = ConstructionCategory::orderBy('name','asc')->get();
        $constructionVideos = ConstructionVideo::all();

        return view('Frontend.construction',compact('constructionVideos','category'));

    }
    public function ConstructionCategory($id) {
        $category = ConstructionCategory::orderBy('name','asc')->get();
        $constructionVideos = ConstructionVideo::where('category_id',$id)->get();

        return view('Frontend.construction',compact('constructionVideos','category'));

    }
}
