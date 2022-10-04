<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Term;

class TermController extends Controller
{
    public function index(){
        $term = Term::orderBy('id','ASC')->get();

        return view('Frontend.term',compact('term'));
    }
}
