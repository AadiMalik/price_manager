<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Controllers\Controller;
use App\Industry;
use App\User;
use App\UserPackage;
use App\BuyPackage;
use App\UserRating;
use App\UserType;
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;
use Illuminate\Support\Str;
use Validator;
use Storage;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $users = User::where('email', '!=', 'admin@gmail.com')->where('status','!=',2)->get();
        return view('Backend.user.index', compact('users'));
    }
    public function block()
    {
        $users = User::where('email', '!=', 'admin@gmail.com')->where('status','=',2)->get();
        return view('Backend.user.block', compact('users'));
    }
    
    public function indexAPI(Request $request)
    {
        if($request->token){
            $users = User::where('token', $request->token)->first();
            return response()->json($users);
        }else{
            return response()->json('Login First!');
        }
        
    }
    
    public function storeAPI(Request $request)
    {
        

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = 1;
            $user->phone_no = $request->phone_no;
            $user->user_type = $request->user_type;
            $user->token = md5($request->name);
            $user->password = Hash::make($request->password);
            $user->password_without_hash = $request->password;
            if($user->save()){
                \LogActivity::addToLog('User Create');
                return response()->json($user);
            }else{
                return response()->json('0');
            }
            
        
            
            
    }
    
    public function loginAPI(Request $request)
    {
        $users = User::where('email', $request->email)->first();
        
        if($users!=null){
            if(Hash::check($request->password, $users->password)){
            return response()->json($users);
        }else{
            return response()->json('Password is Invalid');
        }
        }else{
            return response()->json('Email is Invalid');
        }
        
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userTypes = UserType::orderBy('name','ASC')->get();
        $userPackages = UserPackage::all();
        $userRatings = UserRating::all();
        $cities = City::orderBy('name','ASC')->get();;
        $industries = Industry::orderBy('name','ASC')->get();;
        $brands = Brand::orderBy('name','ASC')->get();;
        return view('Backend.user.create', compact('userRatings','userTypes', 'userPackages', 'cities','industries','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg',
//            'website_url' => 'nullable|url',
            'phone_no' => 'required|digits:11|unique:users,phone_no',
            // 'validity_day' => 'required|gt:0',
            'user_type' => 'required',
            'brand_id' => 'nullable',
            'package' => 'required',
            'description' => 'required',
            'city' => 'required',
            'industry' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
           
            $user = new User;
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'userProfile/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $user->image_url = $upload.$filename;
            }
            // if ($request->has('image')) {
            //     if ($user->image_url) {
            //         Storage::delete($user->image_url);
            //     }
            //     $fileFolder = 'userProfile';
            //     if (!Storage::exists($fileFolder)) {
            //         Storage::makeDirectory($fileFolder);
            //     }

            //     $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
            //     $user->image_url = $imageUrl;
            // }
            $password = Str::random(8);
            $package = UserPackage::findOrFail($request->package);
            
            $user->name = $request->name;
            $user->email = $request->email;

            $user->status =1;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->address = $request->address;
//            $user->website_url = $request->website_url;
            $user->phone_no = $request->phone_no;
            $user->validity_day = $package->validity_day;
            $user->user_type = $request->user_type;
            $user->token = md5($request->name);
//            $user->user_rating = $request->user_rating;
            $user->user_package = $request->package;
            $user->activation_date = now()->today();
            $user->city_id = $request->city;
            $user->industry_id = $request->industry;
            $user->password = Hash::make($password);
            $user->password_without_hash = $password;
            $user->expiry_date = now()->addDays($package->validity_day);
            $user->brand_id = isset($request->brand_id);
            $user->description = $request->description;
            $user->save();
            \LogActivity::addToLog("User Account Create of {$request->name}");
            SendEmail::dispatch($user);
            

            return redirect()->route('indexUser')->with('success', 'User added successfully');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userTypes = UserType::all();
        $userPackages = UserPackage::all();
//        $userRatings = UserRating::all();
        $cities = City::all();
        $industries = Industry::all();
        $brands = Brand::all();
        return view('Backend.user.edit',compact('user','userTypes','userPackages','cities','industries','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
//            'name' => 'required|unique:users,name',
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
//            'website_url' => 'required',
//            'phone_no' => 'required|digits:11',
            'user_type' => 'required',
//            'user_rating' => 'required',
            // 'package' => 'required',
            'description' => 'required',
            'city' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'userProfile/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $user->image_url = $upload.$filename;
            }
            $package = UserPackage::findOrFail($request->package);

//            $user->name = $request->name;
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->address = $request->address;
//            $user->website_url = $request->website_url;
//            $user->phone_no = $request->phone_no;
            //$user->token = md5($request->name);
            $user->status = $request->status;
            $user->user_type = $request->user_type;
//            $user->user_rating = $request->user_rating;
            $user->user_package = $request->package;
            $user->industry_id = $request->industry;
            $user->city_id = $request->city;
            $user->description = $request->description;
            if ($request->has('packageUpdate')) {
                $buyPackage = new BuyPackage;
                if($user->user_package!=null){
                    $buyPackage->pre_package =$user->user_package;
                }
                if($user->expiry_date!=null){
                    $buyPackage->pre_expiry = $user->expiry_date;
                }
                if($user->validity_day!=null){
                    $buyPackage->pre_days = $user->validity_day;
                }
                $buyPackage->package_id =$package->id;
                
                $buyPackage->status = 2;
                $buyPackage->user_id = $user->id;
                $buyPackage->update_by = auth()->user()->id;
                $buyPackage->description = 'Update Package from User Update';
                
                $fdate= date('Y-m-d');
                $tdate=$user->expiry_date;
                $datetime1 = new \DateTime($fdate);
                $datetime2 = new \DateTime($tdate);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');
                $newDate = now()->addDays($package->validity_day + $days+1);
                $buyPackage->expiry = $newDate;
                $buyPackage->save();
                if($user->expiry_date>=now()){
                    $user->expiry_date = now()->addDays($package->validity_day + $days+1);
                $user->validity_day = $package->validity_day + $days;
                }else{
                    $user->expiry_date = now()->addDays($package->validity_day);
                    $user->validity_day = $package->validity_day;
                }
                
                
                \LogActivity::addToLog("Update Package of {$user->name}");
                
            }
            $user->brand_id = isset($request->brand_id);
            \LogActivity::addToLog("Update Account of {$user->name}");
            $user->update();

            return redirect()->route('indexUser')->with('success', 'User update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if ($user->image_url) {
        //     Storage::delete($user->image_url);
        // }

//        if ($user->email == 'admin@gmail.com') {
//            return response()->json([
//                'status' => 0,
//                'message' => 'You are not delete this'
//            ]);
//        }
        \LogActivity::addToLog("Delete Account of {$user->name}");
        $user->delete();
        
        return response()->json([
            'status' => 1,
            'message' => 'User deleted successfully'
        ]);
    }
    public function verify($id)
    {
        
        $user = User::find($id);
        if($user->verify==0){
            $user->verify=1;
            $user->update();
            return back();
        }else{
            $user->verify=0;
            $user->update();
            return back();
        }
    }
    public function Active($id)
    {
        
        $user = User::find($id);
        if($user->status==1 || $user->status==null){
            $user->status=2;
            $user->update();
            return back();
        }else{
            $user->status=1;
            $user->update();
            return back();
        }
    }                                                                                 // Update User Package by Admin
    public function userPackageindex(){
        $users = User::all();

        return view('Backend.packageUpdate.index',compact('users'));
    }
    
    public function userPackageedit($id){
        $user = User::find($id);
        return view('Backend.packageUpdate.edit',compact('user'));
    }
    
    public function userPackageUpdate(Request $request, $id)
    {
        $start_time = Carbon::parse(now());
        $finish_time = Carbon::parse($request->input('expiry'));
        $result = $start_time->diffInDays($finish_time, false);
        $validator = Validator::make($request->all(), [
            'expiry' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $user = User::find($id);
            $user->validity_day = (int)$result+1;
            $user->expiry_date = $request->expiry;
            \LogActivity::addToLog("Update Expiry Date of {$user->name}");
            $user->update();

            return redirect()->route('indexUserPackage')->with('success', 'User Package update successfully');
        }
    }
}
