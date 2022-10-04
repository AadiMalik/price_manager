<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use App\City;
use App\User;
use App\SliderImage;
use App\UserPackage;
use App\Brand;
use App\Product;
use Validator;
use Storage;
use Hash;
use DB;
use App\Conversation;
class HomeController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $packageCount = UserPackage::count();
        $brandCount = User::where('brand_id',1)->count();
        $productCount = Product::count();
        $registerUserCount = User::where('expiry_date','>=',date('Y-m-d'))->count();
        $result = DB::table('visitors')->count();
        return view('home',compact('userCount','packageCount','brandCount','productCount','registerUserCount','result'));
    }

    public function userProfile()
    {
        $user = Auth::user();
        
        $cities = City::all();
        // dd($user);
        return view('Backend.user.profile', compact('user','cities'));
    }
    

    public function updateUserProfile(Request $request)
    {
        $passwordValidation = '';
        if($request->password || $request->password_confirmation) {
            $passwordValidation =  ['required', 'string', 'min:8', 'confirmed'];
        }
        

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'password' => $passwordValidation,
            'image' => 'nullable|mimes:png,jpg,jpeg,gif',
            'images.*' => 'nullable|mimes:png,jpg,jpeg,gif',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $user = User::where('id','=',auth()->user()->id)->first();
if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'userProfile/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $user->image_url = $upload.$filename;;
            }
//             if ($request->has('image')) {
//                 if ($user->image_url) {
                      
//                     if(File::exists('storage/app/public/'.$user->image_url)) {
//                         File::delete('storage/app/public/'.$user->image_url);
//                     }
//                 }
//                 $fileFolder = 'userProfile';
// //
//                 if (!Storage::exists($fileFolder)) {
//                     Storage::makeDirectory($fileFolder);
//                 }

//                 $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
//                 $user->image_url = $imageUrl;
//             }
            
            if($request->password) {
                $user->password =  Hash::make($request->password);
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->city_id = $request->city;
            $user->address = $request->address;
            //$user->token = md5($request->name);
            $user->description = $request->description;
            \LogActivity::addToLog("Profile Update");
            $user->update();
            if($request->has('images')){
             foreach($request-> images as $index=> $image) {
                $fileFolder = 'userProductImage';
                if (!Storage::exists($fileFolder)) {
                    Storage::makeDirectory($fileFolder);
                }

                $imageUrl = Storage::disk('public')->putFile($fileFolder, $image);
                $data = DB::table('user_images')
               ->insert(['image_url' =>$imageUrl,'user_id'=> $user->id ,'created_at' => now(),'updated_at' => now()]);

            }   
            }
            

            return redirect()->route('home')->with('success', 'Your profile updated');

        }
    }
    public function sliderGallery(){
        $user_images = SliderImage::where('user_id','=',Auth::user()->id)->paginate(8);
        return view('Backend.slidergallery.index', compact('user_images'));
    }

    public function sliderGalleryUpload(Request $request){
     
     
        $validator = Validator::make($request->all(), [
            'images' => 'nullable|mimes:png,jpg,jpeg,gif',
        ]);
        $data = new SliderImage;
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            if($request->hasfile('images')){
            $image = $request->file('images');
            $upload = 'sliderImage/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $data->image_url = $upload.$filename;
            }
            $data->user_id =Auth::user()->id;
            \LogActivity::addToLog("User Slider Gallery Store");
            $data->save();
            return back()->with(["status" => "success", "message" => "Gallery images upload successfuly"]);
        }
    }
    public function deleteGalleryImage($id){
        $user_image = SliderImage::where('id','=',$id)->first();
        if(File::exists($user_image->image_url)) {
            File::delete($user_image->image_url);
        }
        
            \LogActivity::addToLog("User Slider Gallery Delete id:{$id}");
        $user_image->delete();
        return redirect('/slider-gallery')->with(["status" => "success", "message" => "Image removed successfuly"]);
    }
    public function getViewUpdatePassword(){
        
        return view('Backend.user.password');
    }
    public function UpdatePassword(Request $request){
   
        

        $validator = Validator::make($request->all(), [
            'password' =>  ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $user = auth()->user();

            
            if($request->password) {
                $user->password =  Hash::make($request->password);
            }
            $user->save();
            

            return redirect()->route('home')->with('success', 'Your Password updated');

        }
    }
    // public function chat(){
    //     $users = User::whereNotIn('id', [Auth::user()->id])->with('conversations')->get();
    //     foreach($users as $user){
    //         $conversation = $user->conversations()->wherePivotIn('user_id', [$user->id, Auth::user()->id])->has('users', count([$user->id, Auth::user()->id]))->first();
    //         if(!$conversation){
    //             $conversation_id = Conversation::create()->id;
    //             $user->conversations()->syncWithoutDetaching($conversation_id);
    //             Auth::user()->conversations()->syncWithoutDetaching($conversation_id);
    //         }
    //         $user->conversation_id = $conversation->id; 
    //     }
    
    //     return view('backend.chat', compact('users'));
    // }

    //  public function chat(){
    //     $users = User::whereNotIn('id', [Auth::user()->id])->get();
    //     foreach($users as $user){
    //        $conversation = Conversation::where(function ($query) use ($user) {
    //             $query->where('user_id_1', '=', Auth::user()->id)
    //                   ->where('user_id_2', '=', $user->id);
    //         })->orWhere(function ($query) use ($user) {
    //             $query->where('user_id_1', '=', $user->id)
    //                   ->where('user_id_2', '=', Auth::user()->id);
    //         })->first();

            
    //         if(!$conversation){
    //             $conversation = Conversation::create([
    //                 'user_id_1' => $user->id,
    //                 'user_id_2' => Auth::user()->id
    //             ]);
    //                         }
    //         $user->conversation_id = $conversation->id; 
    //     }
    //     return view('Backend.chat', compact('users'));
    // }
    public function chat(){
        $users = User::whereNotIn('id', [Auth::user()->id])->get();
        foreach($users as $user){
           $conversation = Conversation::where(function ($query) use ($user) {
                $query->where('user_id_1', '=', Auth::user()->id)
                      ->where('user_id_2', '=', $user->id);
            })->orWhere(function ($query) use ($user) {
                $query->where('user_id_1', '=', $user->id)
                      ->where('user_id_2', '=', Auth::user()->id);
            })->first();

            
            if($conversation){
                $user->conversation_id = $conversation->id; 
            }
            
        }
        return view('Backend.chat', compact('users'));
    }
}
