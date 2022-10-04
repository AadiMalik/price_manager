<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Product;
use App\SliderImage;
use App\SiteContent;
use App\Industry;
use App\City;
use App\UserType;
use App\RemarksImage;
use App\RemarksVideo;
use App\ConstructionVideo;
use App\UserPackage;
use App\ContactUs;
use App\Review;
use App\UserPhone;
use Storage;
use File;
use DB;

class UserController extends Controller
{
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
            $result = $user->save();
            if(!$result){
                return response()->json('0');
            }else{
                return response()->json($user);
            }   
    }
    
    public function loginAPI(Request $request)
    {
        $users = User::with('city')->where('email', $request->email)->first();
        
        if($users!=null)
        {
            if(Hash::check($request->password, $users->password)){
                $user1 = array();
                    $user1[] = [
                                "id" =>  $users->id,
                                "name" =>  $users->name,
                                "email" =>  $users->email,
                                "phone_no" =>  $users->phone_no,
                                "status" =>  $users->status,
                                "first_name" =>  $users->first_name,
                                "last_name" =>  $users->last_name,
                                "address" =>  $users->address,
                                "token" =>  $users->token,
                                "description" =>  $users->description,
                                "image_url" =>  url('/').'/storage/app/public/'.$users->image_url,
                                "city_id" =>  $users->city_id,
                                
                                "created_at" =>  $users->created_at,
                                "updated_at" =>  $users->updated_at,
                        
                        ];
            return response()->json($user1);
        }else{
            return response()->json('Password is Invalid');
        }
        }else{
            return response()->json('Email is Invalid');
        }
        
        
    }
    public function profileAPI(Request $request)
    {
        
        if($request->id != null){
            $user = User::find($request->id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->address = $request->address;
            $user->city_id = $request->city_id;
            if ($request->has('image')) {
                if ($user->image_url) {
                    Storage::delete($user->image_url);
                }
                $fileFolder = 'userProfile';
//
                if (!Storage::exists($fileFolder)) {
                    Storage::makeDirectory($fileFolder);
                }

                $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
                $user->image_url = $imageUrl;
            }
            $user->description = $request->description;
            $result = $user->update();
            if($result){
                return response()->json('1');
            }else{
                return response()->json('0');
            }
            
        }else{
            return response()->json('Login First!');
        }
    }
    public function passwordAPI(Request $request)
    {
        
        $check= User::where('id', $request->id)->first();
        
        if($check!=null){
            if($request->password){
                if($request->password == $request->confirm_password){
                    $users = User::find($check->id);
                    $users->password = Hash::make($request->password);
                    $users->password_without_hash = $request->password;
                    $users->update();
                    return response()->json('Password is Updated');
                }else{
                    return response()->json('Password dos not Match!');
                }
            }else{
                return response()->json('Please insert password');
            }
        }else{
            return response()->json('Please Login First');
        }
        
        
    }
    public function product(Request $request)
    {
        $product = Product::where('user_id', $request->id)->get();
        $produc = array();
        foreach($product as $products){
            $produc[] = [
                        "id" =>  $products->id,
                        "name" =>  $products->name,
                        "price" =>  $products->price,
                        "quality" =>  $products->quality,
                        "size" =>  $products->size,
                        "description" =>  $products->description,
                        "image_url" =>  url('/').'/storage/app/public/'.$products->image_url,
                        "user_id" =>  $products->user_id,
                        "created_at" =>  $products->created_at,
                        "updated_at" =>  $products->updated_at,
                
                ];
        }
        return response()->json($produc);
    }
    public function productEdit(Request $request)
    {
        $product = Product::where('id', $request->id)->get();
        $produc = array();
        foreach($product as $products){
            $produc[] = [
                        "id" =>  $products->id,
                        "name" =>  $products->name,
                        "price" =>  $products->price,
                        "quality" =>  $products->quality,
                        "size" =>  $products->size,
                        "description" =>  $products->description,
                        "image_url" =>  url('/').'/storage/app/public/'.$products->image_url,
                        "user_id" =>  $products->user_id,
                        "created_at" =>  $products->created_at,
                        "updated_at" =>  $products->updated_at,
                
                ];
        }
        return response()->json($produc);
    }
    public function productUpdate(Request $request)
    {
        // $validation=$request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'quality' => 'required',
        //     'size' => 'required',
        //     'description' => 'required',
        //     'image'   => 'required'
        // ]);
        $data = [
            
            'name' => ucwords($request->name),
            'price' => $request->price,
            'quality' => $request->quality,
            'size' => $request->size,
            'description' => $request->description,
        ];

        if ($request->has('image')!=null) {
            $fileFolder = 'userProduct';
            
            if (!Storage::exists($fileFolder)) {
                Storage::makeDirectory($fileFolder);
            }
            

            $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
            $data['image_url'] = $imageUrl;
        }else{
            return response()->json('Image is Required!');
        }
        $product = Product::find($request->id);
        if($product){
            $product->update($data);
            return response()->json('Product is Updated!');
        }
           
    }
    public function Slider(Request $request)
    {
        
        $slider = SliderImage::where('user_id',$request->id)->get();
        $sliderimages = array();
        foreach($slider as $slide){
            $sliderimages[] = [
                        "id" =>  $slide->id,
                        "image_url" =>  url('/').'/storage/app/public/'.$slide->image_url,
                        "user_id" =>  $slide->user_id,
                        "created_at" =>  $slide->created_at,
                        "updated_at" =>  $slide->updated_at,
                
                ];
        }
        return response()->json(['slider_images' => $sliderimages ]);
    }
    public function Site_Content()
    {
        $content = SiteContent::where('page','!=','Home Page Carousel')->get();
        return response()->json($content);
    }
    public function Industry()
    {
        $industry = Industry::all();
        return response()->json($industry);
    }
    public function User_type()
    {
        $user_type = UserType::all();
        return response()->json($user_type);
    }
    public function City()
    {
        $city = City::all();
        return response()->json($city);
    }

    public function Brand()
    {
        $brand = User::where('brand_id',1)->get();
        $brands =  array();  
        foreach($brand as $bran){
            $brands[] = [
                    "id"                    => $bran->id,
                    "name"                  => $bran->name,
                    "email"                 => $bran->email,
                    "status"                => $bran->status,
                    "email_verified_at"     => $bran->email_verified_at,
                    "password_without_hash" => $bran->password_without_hash,
                    "image_url"             => url('/').'/storage/app/public/'.$bran->image_url,
                    "first_name"            => $bran->first_name,
                    "last_name"             => $bran->last_name,
                    "address"               => $bran->address,
                    "token"                 => $bran->token,
                    "website_url"           => $bran->website_url,
                    "phone_no"              => $bran->phone_no,
                    "activation_date"       => $bran->activation_date,
                    "validity_day"          => $bran->validity_day,
                    "user_type"             => $bran->user_type,
                    "user_package"          => $bran->user_package,
                    "city_id"               => $bran->city_id,
                    "industry_id"           => $bran->industry_id,
                    "expiry_date"           => $bran->expiry_dateid,
                    "view"                  => $bran->view,
                    "brand_id"              => $bran->brand_id,
                    "description"           => $bran->description,
                    "created_at"            => $bran->created_at,
                    "updated_at"            => $bran->updated_at,    
                
                ];
        }
        return response()->json($brands);
    }

    public function Construction()
    {
        $construction = ConstructionVideo::all();
        return response()->json($construction);
    }

    public function company(){
        $companies = User::with('city','userType', 'products','reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->whereHas('products', function($q)
        {
            $q->where('price','>', 0);
        })->get();
            
        $compani = array();
        foreach($companies as $company){
            $rating = DB::table('reviews')
                -> where('user_product_id','=',$company->id)->sum('rating');
            $countrating =DB::table('reviews')
                -> where('user_product_id','=',$company->id)
                -> count();
            if($rating >  '0' && $countrating > '0'){
                $userrating = $rating/$countrating;
            }else{
                $userrating = '0';
            }
            $products = array();
            foreach($company->products as $product){
                
                $products[] = [
                        "id"            =>  $product->id ,
                        "user_id"       =>  $product->user_id ,
                        "name"          =>  $product->name ,
                        "price"         =>  $product->price ,
                        "quality"       =>  $product->quality ,
                        "size"          =>  $product->size ,
                        "image_url"     =>  url('/').'/storage/app/public/'.$product->image_url ,
                        "description"   =>  $product->description ,
                        "paid_users_id" =>  $product->paid_users_id ,
                        "created_at"    =>  $product->created_at ,
                        "updated_at"    =>  $product->updated_at ,
                ];
            }
            // $reviews = array();
            // foreach($company->reviews as $review){
            //     $reviews[] = [
            //                         "id"                =>  $review->id ,
            //                         "rating"            =>  $review->rating ,
            //                         "message"           =>  $review->message ,
            //                         "image_url"         =>  url('/').'/storage/app/public/'.$review->image_url ,
            //                         "user_product_id"   =>  $review->user_product_id ,
            //                         "auth_user_id"      =>  $review->auth_user_id ,
            //                         "created_at"        =>  $review->created_at ,
            //                         "updated_at"        =>  $review->updated_at ,
            //                 ];
            // }
            $compani[] = [
                            "id"                    => $company->id,
                            "name"                  => $company->name,
                            "email"                 => $company->email,
                            "status"                => $company->status,
                            "email_verified_at"     => $company->email_verified_at,
                            "password_without_hash" => $company->password_without_hash,
                            "image_url"             => url('/').'/storage/app/public/'.$company->image_url,
                            "first_name"            => $company->first_name,
                            "last_name"             => $company->last_name,
                            "address"               => $company->address,
                            "token"                 => $company->token,
                            "website_url"           => $company->website_url,
                            "phone_no"              => $company->phone_no,
                            "activation_date"       => $company->activation_date,
                            "validity_day"          => $company->validity_day,
                            "user_type"             => $company->user_type,
                            "user_package"          => $company->user_package,
                            "rating"               => $userrating,
                            "city_id"               => $company->city_id,
                            "industry_id"           => $company->industry_id,
                            "expiry_date"           => $company->expiry_date,
                            "view"                  => $company->view,
                            "brand_id"              => $company->brand_id,
                            "description"           => $company->description,
                            "created_at"            => $company->created_at,
                            "updated_at"            => $company->updated_at,
                            "city"                  => [
                                                            "id"         => $company->city->id,
                                                            "name"       => $company->city->name,
                                                            "created_at" => $company->city->created_at,
                                                            "updated_at" => $company->city->updated_at,
                                                    ],
                            "userType"                  => [
                                                            "id"         => $company->userType->id,
                                                            "name"       => $company->userType->name,
                                                            "created_at" => $company->userType->created_at,
                                                            "updated_at" => $company->userType->updated_at,
                                                    ],
                            "products"              => $products,
                            
                ];
        }
        return response()->json($compani);
    }
    
    public function brickscompany(){
        $companies = User::with('city','userType', 'products','reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->where('industry_id',1)->whereHas('products', function($q)
        {
            $q->where('price','>', 0);
        })->get();
        
        $compani = array();
        
        foreach($companies as $company){
            $rating = DB::table('reviews')
                -> where('user_product_id','=',$company->id)->sum('rating');
            $countrating =DB::table('reviews')
                -> where('user_product_id','=',$company->id)
                -> count();
            if($rating >  '0' && $countrating > '0'){
                $userrating = $rating/$countrating;
            }else{
                $userrating = '0';
            }
            $products = array();
            foreach($company->products as $product){
                $products[] = [
                        "id"            =>  $product->id ,
                        "user_id"       =>  $product->user_id ,
                        "name"          =>  $product->name ,
                        "price"         =>  $product->price ,
                        "quality"       =>  $product->quality ,
                        "size"          =>  $product->size ,
                        "image_url"     =>  url('/').'/storage/app/public/'.$product->image_url ,
                        "description"   =>  $product->description ,
                        "paid_users_id" =>  $product->paid_users_id ,
                        "created_at"    =>  $product->created_at ,
                        "updated_at"    =>  $product->updated_at ,
                ];
            }
            $reviews = array();
            foreach($company->reviews as $review){
                $reviews[] = [
                                    "id"                =>  $review->id ,
                                    "rating"            =>  $review->rating ,
                                    "message"           =>  $review->message ,
                                    "image_url"         =>  url('/').'/storage/app/public/'.$review->image_url ,
                                    "user_product_id"   =>  $review->user_product_id ,
                                    "auth_user_id"      =>  $review->auth_user_id ,
                                    "created_at"        =>  $review->created_at ,
                                    "updated_at"        =>  $review->updated_at ,
                            ];
            }
            $compani[] = [
                            "id"                    => $company->id,
                            "name"                  => $company->name,
                            "email"                 => $company->email,
                            "status"                => $company->status,
                            "email_verified_at"     => $company->email_verified_at,
                            "password_without_hash" => $company->password_without_hash,
                            "image_url"             => url('/').'/storage/app/public/'.$company->image_url,
                            "first_name"            => $company->first_name,
                            "last_name"             => $company->last_name,
                            "address"               => $company->address,
                            "token"                 => $company->token,
                            "website_url"           => $company->website_url,
                            "phone_no"              => $company->phone_no,
                            "activation_date"       => $company->activation_date,
                            "validity_day"          => $company->validity_day,
                            "user_type"             => $company->user_type,
                            "rating"               => $userrating,
                            "user_package"          => $company->user_package,
                            "city_id"               => $company->city_id,
                            "industry_id"           => $company->industry_id,
                            "expiry_date"           => $company->expiry_date,
                            "view"                  => $company->view,
                            "brand_id"              => $company->brand_id,
                            "description"           => $company->description,
                            "created_at"            => $company->created_at,
                            "updated_at"            => $company->updated_at,
                            "city"                  => [
                                                            "id"         => $company->city->id,
                                                            "name"       => $company->city->name,
                                                            "created_at" => $company->city->created_at,
                                                            "updated_at" => $company->city->updated_at,
                                                    ],
                            "userType"                  => [
                                                            "id"         => $company->userType->id,
                                                            "name"       => $company->userType->name,
                                                            "created_at" => $company->userType->created_at,
                                                            "updated_at" => $company->userType->updated_at,
                                                    ],
                            "products"              => $products,
                            
                ];
        }
        return response()->json($compani);
    }
    public function marblecompany(){
        $companies = User::with('city','userType', 'products','reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->where('industry_id','==', 2)->whereHas('products', function($q)
        {
            $q->where('price','>', 0);
        })->get();
        
        $compani = array();
        foreach($companies as $company){
            $rating = DB::table('reviews')
                -> where('user_product_id','=',$company->id)->sum('rating');
            $countrating =DB::table('reviews')
                -> where('user_product_id','=',$company->id)
                -> count();
            if($rating >  '0' && $countrating > '0'){
                $userrating = $rating/$countrating;
            }else{
                $userrating = '0';
            }
            $products = array();
            foreach($company->products as $product){
                $products[] = [
                        "id"            =>  $product->id ,
                        "user_id"       =>  $product->user_id ,
                        "name"          =>  $product->name ,
                        "price"         =>  $product->price ,
                        "quality"       =>  $product->quality ,
                        "size"          =>  $product->size ,
                        "image_url"     =>  url('/').'/storage/app/public/'.$product->image_url ,
                        "description"   =>  $product->description ,
                        "paid_users_id" =>  $product->paid_users_id ,
                        "created_at"    =>  $product->created_at ,
                        "updated_at"    =>  $product->updated_at ,
                ];
            }
            $reviews = array();
            foreach($company->reviews as $review){
                $reviews[] = [
                                    "id"                =>  $review->id ,
                                    "rating"            =>  $review->rating ,
                                    "message"           =>  $review->message ,
                                    "image_url"         =>  url('/').'/storage/app/public/'.$review->image_url ,
                                    "user_product_id"   =>  $review->user_product_id ,
                                    "auth_user_id"      =>  $review->auth_user_id ,
                                    "created_at"        =>  $review->created_at ,
                                    "updated_at"        =>  $review->updated_at ,
                            ];
            }
            $compani[] = [
                            "id"                    => $company->id,
                            "name"                  => $company->name,
                            "email"                 => $company->email,
                            "status"                => $company->status,
                            "email_verified_at"     => $company->email_verified_at,
                            "password_without_hash" => $company->password_without_hash,
                            "image_url"             => url('/').'/storage/app/public/'.$company->image_url,
                            "first_name"            => $company->first_name,
                            "last_name"             => $company->last_name,
                            "address"               => $company->address,
                            "token"                 => $company->token,
                            "website_url"           => $company->website_url,
                            "phone_no"              => $company->phone_no,
                            "activation_date"       => $company->activation_date,
                            "validity_day"          => $company->validity_day,
                            "user_type"             => $company->user_type,
                            "rating"               => $userrating,
                            "user_package"          => $company->user_package,
                            "city_id"               => $company->city_id,
                            "industry_id"           => $company->industry_id,
                            "expiry_date"           => $company->expiry_date,
                            "view"                  => $company->view,
                            "brand_id"              => $company->brand_id,
                            "description"           => $company->description,
                            "created_at"            => $company->created_at,
                            "updated_at"            => $company->updated_at,
                            "city"                  => [
                                                            "id"         => $company->city->id,
                                                            "name"       => $company->city->name,
                                                            "created_at" => $company->city->created_at,
                                                            "updated_at" => $company->city->updated_at,
                                                    ],
                            "userType"                  => [
                                                            "id"         => $company->userType->id,
                                                            "name"       => $company->userType->name,
                                                            "created_at" => $company->userType->created_at,
                                                            "updated_at" => $company->userType->updated_at,
                                                    ],
                            "products"              => $products,
                ];
        }
        return response()->json($compani);
    }

    public function search(Request $request){
        $search = User::with('city', 'userRating', 'userType', 'products', 'userPackage' ,'reviews')->where('email', '!=', 'admin@gmail.com')->whereHas('products', function($q)
{
    $q->where('price','>', 1);

});
        if ($request->city) {
            if ($request->city != 'all') {
                $search->where('city_id', $request->city_id);
            }
        }

        if ($request->user_type) {
            if ($request->user_type != 'all') {
                $search->where('user_type', $request->user_type);
            };
        }

        if ($request->industry) {
            if ($request->industry != 'all') {
                $search->where('industry_id', $request->industry_id);
            };
        }

        $search = $search->get();
        
$compani = array();
        foreach($search as $company){
            $rating = DB::table('reviews')
                -> where('user_product_id','=',$company->id)->sum('rating');
            $countrating =DB::table('reviews')
                -> where('user_product_id','=',$company->id)
                -> count();
            if($rating >  0){
                $userrating = $rating/$countrating;
            }else{
                $userrating =0;
            }
            $products = array();
            foreach($company->products as $product){
                $products[] = [
                        "id"            =>  $product->id ,
                        "user_id"       =>  $product->user_id ,
                        "name"          =>  $product->name ,
                        "price"         =>  $product->price ,
                        "quality"       =>  $product->quality ,
                        "size"          =>  $product->size ,
                        "image_url"     =>  url('/').'/storage/app/public/'.$product->image_url ,
                        "description"   =>  $product->description ,
                        "paid_users_id" =>  $product->paid_users_id ,
                        "created_at"    =>  $product->created_at ,
                        "updated_at"    =>  $product->updated_at ,
                ];
            }
            
            $compani[] = [
                            "id"                    => $company->id,
                            "name"                  => $company->name,
                            "email"                 => $company->email,
                            "status"                => $company->status,
                            "email_verified_at"     => $company->email_verified_at,
                            "password_without_hash" => $company->password_without_hash,
                            "image_url"             => url('/').'/storage/app/public/'.$company->image_url,
                            "first_name"            => $company->first_name,
                            "last_name"             => $company->last_name,
                            "address"               => $company->address,
                            "token"                 => $company->token,
                            "website_url"           => $company->website_url,
                            "phone_no"              => $company->phone_no,
                            "activation_date"       => $company->activation_date,
                            "validity_day"          => $company->validity_day,
                            "user_type"             => $company->user_type,
                            "rating"               => $userrating,
                            "user_package"          => $company->user_package,
                            "city_id"               => $company->city_id,
                            "industry_id"           => $company->industry_id,
                            "expiry_date"           => $company->expiry_date,
                            "view"                  => $company->view,
                            "brand_id"              => $company->brand_id,
                            "description"           => $company->description,
                            "created_at"            => $company->created_at,
                            "updated_at"            => $company->updated_at,
                            "city"                  => [
                                                            "id"         => $company->city->id,
                                                            "name"       => $company->city->name,
                                                            "created_at" => $company->city->created_at,
                                                            "updated_at" => $company->city->updated_at,
                                                    ],
                            "userType"                  => [
                                                            "id"         => $company->userType->id,
                                                            "name"       => $company->userType->name,
                                                            "created_at" => $company->userType->created_at,
                                                            "updated_at" => $company->userType->updated_at,
                                                    ],
                            "products"              => $products,
                            
                ];
        }
        return response()->json($compani);
    }


    public function userDetail (Request $request) {
        $user = User::findOrFail($request->id);
        $rating = DB::table('reviews')
                -> where('user_product_id','=',$request->id)->sum('rating');
        $countrating =DB::table('reviews')
                -> where('user_product_id','=',$request->id)
                -> count();
        if($rating >  0){
            $userrating = $rating/$countrating;
        }else{
            $userrating =0;
        }
        
        $user_detail = User::with('userType','city', 'products','reviews','userPackage')->where('id',$request->id)->whereHas('products', function($q)
        {
            $q->where('price','>', 0);
        })->get();
        $users = array();
            foreach($user_detail as $user){
                $users[] = [
                        "id"            =>  $user->id ,
                        "name"       =>  $user->name ,
                        "first_name"          =>  $user->first_name,
                        "last_name"         =>  $user->last_name ,
                        "phone_no"       =>  $user->phone_no ,
                        "user_type"          =>  $user->user_type ,
                        "rating" =>$userrating,
                        "user_package"          =>  $user->user_package ,
                        "image_url"     =>  url('/').'/storage/app/public/'.$user->image_url ,
                        "city_id"   =>  $user->city_id ,
                        "city"                  => [
                                                            "id"         => $user->city->id,
                                                            "name"       => $user->city->name,
                                                            "created_at" => $user->city->created_at,
                                                            "updated_at" => $user->city->updated_at,
                                                    ],
                        "userType"              => [
                                                            "id"         => $user->userType->id,
                                                            "name"       => $user->userType->name,
                                                            "created_at" => $user->userType->created_at,
                                                            "updated_at" => $user->userType->updated_at,
                                                    ],
                        "userPackage"                  => [
                                                            "id"         => $user->userPackage->id,
                                                            "name"       => $user->userPackage->name,
                                                            "price"       => $user->userPackage->price,
                                                            "description"       => $user->userPackage->description,
                                                            "created_at" => $user->userPackage->created_at,
                                                            "updated_at" => $user->userPackage->updated_at,
                                                    ],
                        "description" =>  $user->description ,
                        "created_at"    =>  $user->created_at ,
                        "updated_at"    =>  $user->updated_at ,
                ];
            }

        return response()->json(['user_detail' => $users]);
        
    }
    public function userProduct(Request $request){
        $product = Product::where('user_id',$request->id)->get();
        
        $products = array();
            foreach($product as $product){
                $products[] = [
                        "id"            =>  $product->id ,
                        "user_id"       =>  $product->user_id ,
                        "name"          =>  $product->name ,
                        "price"         =>  $product->price ,
                        "quality"       =>  $product->quality ,
                        "size"          =>  $product->size ,
                        "image_url"     =>  url('/').'/storage/app/public/'.$product->image_url ,
                        "description"   =>  $product->description ,
                        "paid_users_id" =>  $product->paid_users_id ,
                        "created_at"    =>  $product->created_at ,
                        "updated_at"    =>  $product->updated_at ,
                ];
            }
            return response()->json(['userProduct' => $products]);
    }

    public function userImageRemarks (Request $request) {
        $ImageRemarks = RemarksImage::where('user_id',$request->id)->get();
        $remarkimages = array();
        foreach($ImageRemarks as $image){
            $remarkimages[] = [
                        "id" =>  $image->id,
                        "image_url" =>  url('/').'/storage/app/public/'.$image->image_url,
                        "user_id" =>  $image->user_id,
                        "description" =>  $image->description,
                        "created_at" =>  $image->created_at,
                        "updated_at" =>  $image->updated_at,
                
                ];
        }
        return response()->json(['user_remarkimages'=> $remarkimages]);
        
    }
    public function userVideoRemarks (Request $request) {
        $VideoRemarks = RemarksVideo::where('user_id',$request->id)->get();

        return response()->json(['user_remarkvideo' => $VideoRemarks]);
        
    }

    public function VideoRemarks() {
        $Videos = RemarksVideo::all();

        return response()->json($Videos);
        
    }
    public function ImageRemarks() {
        $images = RemarksImage::all();
        $remarkimages = array();
        foreach($images as $image){
            $remarkimages[] = [
                        "id" =>  $image->id,
                        "image_url" =>  url('/').'/storage/app/public/'.$image->image_url,
                        "user_id" =>  $image->user_id,
                        "description" =>  $image->description,
                        "created_at" =>  $image->created_at,
                        "updated_at" =>  $image->updated_at,
                
                ];
        }
        return response()->json(['remarkimages' => $remarkimages]);
        
    }

    public function Packages() {
        $packages = UserPackage::all();
         $userpackage = array();
        foreach($packages as $index => $package){
        $features = unserialize($package->feature);
            $userpackage[] = [
                        "id" =>  $package->id,
                        "name" =>  $package->name,
                        "price" =>  $package->price,
                        "description" =>  $package->description,
                        "Feature1" =>  $features[0],
                        "Feature2" =>  $features[1],
                        "Feature3" =>  $features[2],
                        "validity_day" => $package->validity_day,
                        "created_at" =>  $package->created_at,
                        "updated_at" =>  $package->updated_at,
                
                ];
        }
        return response()->json(['packages'=> $userpackage]);
        
    }

    public function storeContact (Request $request) {
        
            $contact = new ContactUs;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $result = $contact->save();
            if(!$result){
                return response()->json('0');
            }else{
                return response()->json('1');
            }
            
    }
    
    public function homepage_slider(){
        $sliders = SiteContent::where('page','=','Home Page Carousel')->get();
        $images = array();
        foreach($sliders as $slider ){
            $images[] = [
                    'images'    => url('/').'/'.'storage/app/public/'.$slider->content,
                ];
        }
        
        return response()->json(['slider_images' => $images ]);
    }
    public function AddReview(Request $request)
    {
        
            $review = new Review;
            $review->rating = $request->rating;
            $review->message = $request->message;
            $review->user_product_id = $request->userdetail_id;
            $review->auth_user_id = $request->user_id;
            if ($request->has('image')) {

                $fileFolder = 'remarksImages';
                if (!Storage::exists($fileFolder)) {
                    Storage::makeDirectory($fileFolder);
                }

                $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
                $imageRemarks->image_url = $imageUrl;
            }
            
            $result = $review->save();
            if(!$result){
                return response()->json('0');
            }else{
                return response()->json('1');
            }   
    }
    public function ShowReview(Request $request) {
        $reviews = Review::with('reviewUser')->where('user_product_id',$request->id)->orderBy('id','DESC')->get();
        
         $revie = array();
        foreach($reviews as $review){
            $revie[] = [
                        "id" =>  $review->id,
                        "user_product_id" =>  $review->user_product_id,
                        
                        "user_id" =>  $review->auth_user_id,
                        "reviewUser"  => [
                                "id"         => $review->reviewUser->id,
                                "name"       => $review->reviewUser->name,
                                "image_url"     =>  url('/').'/storage/app/public/'.$review->reviewUser->image_url ,
                            ],
                        "message" =>  $review->message,
                        "created_at" =>  $review->created_at,
                        "updated_at" =>  $review->updated_at,
                
                ];
        }
        return response()->json(['reviews'=> $revie]);
        
    }
    
    
    public function UserPhone(Request $request)
    {
        
       $phone = new UserPhone;
       $phone->user_id = $request->user_id;
       $phone->user_detail_id = $request->user_detail_id;
       $result = $phone->save();
            if(!$result){
                return response()->json('0');
            }else{
                return response()->json('1');
            }   
    }
    
}
