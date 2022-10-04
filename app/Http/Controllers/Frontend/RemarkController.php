<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\RemarksImage;
use App\RemarksVideo;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    public function showRemarks() {
        $remarksImages = RemarksImage::paginate(12);
        $remarksVideos = RemarksVideo::paginate(6);

        return view('Frontend.remarks',compact('remarksVideos', 'remarksImages'));

    }
}
