<?php

namespace App\Http\Controllers\Frontend;

use App\Brand;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function showBrand() {
        $users = User::all();

        return view('Frontend.brand',compact('users'));

    }
    
    public function getUserAlongWithBrand($id){
        $brand = Brand::find($id);
        $users = User::where('brand_id',$id)->get();
        
        return view('Frontend.specific-brand',compact('users','brand'));
    }
}
