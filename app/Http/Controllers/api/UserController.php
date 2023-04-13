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
use App\ClientReview;
use Storage;
use File;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function loginAPI(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email"    => 'required|email',
                "password" => 'required|string',
            ]);

            if ($validator->fails()) {
                $errors = "";

                foreach ($validator->errors()->all() as $message) {
                    $errors .= $message;
                }

                return response()->json($errors);
            }

            $credentials = ['email' => $request->email, 'password' => $request->password];

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json('Invalid Login Information!');
            } else {

                // authenticate request
                $user = Auth::user();
                
                $user1 = array();
                $user1[] = [
                    "id" =>  $user->id,
                    "name" =>  $user->name,
                    "email" =>  $user->email,
                    "phone_no" =>  $user->phone_no,
                    "status" =>  $user->status,
                    "first_name" =>  $user->first_name,
                    "last_name" =>  $user->last_name,
                    "address" =>  $user->address,
                    "token" =>  $token,
                    "description" =>  $user->description,
                    "image_url" =>  url('/') . '/' . $user->image_url,
                    "city_id" =>  $user->city_id,

                    "created_at" =>  $user->created_at,
                    "updated_at" =>  $user->updated_at,

                ];
                // $data = [
                //     'user' => $user1,
                //     'authorisation' => $token
                // ];
                return response()->json($user1);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'password' => 'required',

        // ]);
        // if ($validator->fails()) {

        //     return response()->json($validator->messages()->first());
        // }
        // $users = User::with('city')->where('email', $request->email)->first();

        // if ($users != null) {
        //     if (Hash::check($request->password, $users->password)) {
        //         $user1 = array();
        //         $user1[] = [
        //             "id" =>  $users->id,
        //             "name" =>  $users->name,
        //             "email" =>  $users->email,
        //             "phone_no" =>  $users->phone_no,
        //             "status" =>  $users->status,
        //             "first_name" =>  $users->first_name,
        //             "last_name" =>  $users->last_name,
        //             "address" =>  $users->address,
        //             "token" =>  $users->token,
        //             "description" =>  $users->description,
        //             "image_url" =>  url('/') . '/' . $users->image_url,
        //             "city_id" =>  $users->city_id,

        //             "created_at" =>  $users->created_at,
        //             "updated_at" =>  $users->updated_at,

        //         ];
        //         return response()->json($user1);
        //     } else {
        //         return response()->json('Password is Invalid');
        //     }
        // } else {
        //     return response()->json('Email is Invalid');
        // }
    }
    public function storeAPI(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'phone_no' => 'required',
            'user_type' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {

            return response()->json(['data' => null, 'message' => $validator->messages(), 'success' => false, 'status' => 406], 200);
        }
        $user = new User;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->status = 1;
        $user->phone_no = $request->phone_no;
        $user->user_type = $request->user_type;
        $user->token = md5($request->name);
        $user->password = Hash::make($request->password);
        $user->password_without_hash = $request->password;
        $result = $user->save();
        if (!$result) {
            return response()->json(['data' => null, 'message' => 'User not register!', 'success' => false, 'status' => 403], 200);
        } else {
            return response()->json(['data' => $user, 'message' => null, 'success' => true, 'status' => 200], 200);
        }
    }
    public function indexAPI(Request $request)
    {
        if ($request->token) {
            $users = User::where('token', $request->token)->first();
            return response()->json($users);
        } else {
            return response()->json('Login First!');
        }
    }
    public function forgetPassword(Request $request)
    {

        $check = User::where('email', $request->email)->first();

        if ($check != null) {
            $password = random_int(1000, 999999);
            $check->password = Hash::make($password);
            $check->update();
            $details = [
                "Name" => $check->name,
                "Password" => $password
            ];
            \Mail::to($check->email)->send(new \App\Mail\ForgetPassword($details));
            return response()->json(['data' => null, 'message' => 'Password send to your email!', 'success' => true, 'status' => 200], 200);
        } else {
            return response()->json(['data' => null, 'message' => 'Email Invalid!', 'success' => false, 'status' => 406], 200);
        }
    }
    public function resetpasswordAPI(Request $request)
    {

        $check = User::where('email', $request->email)->first();

        if ($check != null) {
            if ($request->password) {
                if ($request->password == $request->confirm_password) {
                    $users = User::find($check->id);
                    $users->password = Hash::make($request->password);
                    $users->password_without_hash = $request->password;
                    $users->update();
                    return response()->json('Password is Updated');
                } else {
                    return response()->json('Password dos not Match!');
                }
            } else {
                return response()->json('Please insert password');
            }
        } else {
            return response()->json('Invalid Email');
        }
    }
    public function passwordAPI(Request $request)
    {

        $check = User::where('id', $request->user_id)->first();

        if ($check != null) {
            if ($request->password) {
                if ($request->password == $request->confirm_password) {
                    $users = User::find($check->id);
                    $users->password = Hash::make($request->password);
                    $users->password_without_hash = $request->password;
                    $users->update();
                    return response()->json('Password is Updated');
                } else {
                    return response()->json('Password dos not Match!');
                }
            } else {
                return response()->json('Please insert password');
            }
        } else {
            return response()->json('Please Login First');
        }
    }

    public function product(Request $request)
    {
        $product = Product::where('user_id', $request->user_id)->get();
        $produc = array();
        foreach ($product as $products) {
            $produc[] = [
                "id" =>  $products->id,
                "name" =>  $products->name,
                "price" =>  $products->price,
                'pre_price' => $products->pre_price,
                "quality" =>  $products->quality,
                "size" =>  $products->size,
                "description" =>  $products->description,
                "image_url" =>  url('/') . '/' . $products->image_url,
                "user_id" =>  $products->user_id,
                "created_at" =>  $products->created_at,
                "updated_at" =>  $products->updated_at,

            ];
        }
        return response()->json($produc);
    }
    public function productAdd(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'quality' => 'required',
            'size' => 'required',
            'description' => 'required',
            'image'   => 'required'
        ]);
        if ($validation->fails()) {

            return response()->json(['data' => null, 'message' => $validation->messages()->first(), 'success' => false, 'status' => 406], 200);
        }
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->pre_price = $request->pre_price;
        $product->user_id = $request->user_id;
        $product->quality = $request->quality;
        $product->size = $request->size;
        $product->description = $request->description;
        if ($request->has('image')) {
            $image = $request->file('image');
            $upload = 'userProduct/';
            $filename = time() . $image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload . $filename);
            $product->image_url = $upload . $filename;
        }
        $product->save();
        if ($product) {
            return response()->json(['data' => [], 'message' => 'Product Added!', 'success' => true, 'status' => 200], 200);
        } else {
            return response()->json(['data' => [], 'message' => 'Product Not add!', 'success' => false, 'status' => 200], 200);
        }
    }
    public function productEdit(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        $produc = array();
        foreach ($product as $products) {
            $produc[] = [
                "id" =>  $products->id,
                "name" =>  $products->name,
                "price" =>  $products->price,
                'pre_price' => $products->pre_price,
                "quality" =>  $products->quality,
                "size" =>  $products->size,
                "description" =>  $products->description,
                "image_url" =>  url('/') . '/storage/app/public/' . $products->image_url,
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
            'pre_price' => $request->pre_price,
            'quality' => $request->quality,
            'size' => $request->size,
            'description' => $request->description,
        ];
        if ($request->has('image')) {
            $image = $request->file('image');
            $upload = 'userProduct/';
            $filename = time() . $image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload . $filename);
            $data['image_url'] = $upload . $filename;
        } else {
            return response()->json('Image is Required!');
        }
        $product = Product::find($request->product_id);
        if ($product) {
            $product->update($data);
            return response()->json('Product is Updated!');
        }
    }
    public function Slider(Request $request)
    {

        $slider = SliderImage::where('user_id', $request->company_id)->get();
        $sliderimages = array();
        foreach ($slider as $slide) {
            $sliderimages[] = [
                "id" =>  $slide->id,
                "image_url" =>  url('/') . '/' . $slide->image_url,
                "user_id" =>  $slide->user_id,
                "created_at" =>  $slide->created_at,
                "updated_at" =>  $slide->updated_at,

            ];
        }
        return response()->json(['slider_images' => $sliderimages]);
    }
    public function Site_Content()
    {
        $content = SiteContent::where('page', '!=', 'Home Page Carousel')->get();
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
    public function SearchIndustry()
    {
        $industries = DB::table('users')
            ->join('industries', 'industries.id', 'users.industry_id')
            ->select('industries.id', 'industries.name')
            ->where('users.user_type', '!=', 1)
            ->where('users.user_type', '!=', 2)
            ->where('users.status', '=', 1)
            ->groupBy('users.industry_id', 'industries.id', 'industries.name')
            ->get();
        return response()->json(['data' => $industries, 'message' => null, 'success' => true, 'status' => 200], 200);
    }
    public function SearchCity()
    {
        $cities = DB::table('users')
            ->join('cities', 'cities.id', 'users.city_id')
            ->select('cities.id', 'cities.name')
            ->where('users.user_type', '!=', 1)
            ->where('users.user_type', '!=', 2)
            ->where('users.status', '=', 1)
            ->groupBy('users.city_id', 'cities.id', 'cities.name')
            ->get();
        return response()->json(['data' => $cities, 'message' => null, 'success' => true, 'status' => 200], 200);
    }
    public function homepage_slider()
    {
        $sliders = SiteContent::where('page', '=', 'Home Page Carousel')->get();
        $images = array();
        foreach ($sliders as $slider) {
            $images[] = [
                'images'    => url('/') . '/' . $slider->content,
            ];
        }

        return response()->json(['slider_images' => $images]);
    }
    public function profileAPI(Request $request)
    {

        if ($request->user_id != null) {
            $user = User::find($request->user_id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->address = $request->address;
            $user->city_id = $request->city_id;
            if ($request->has('image')) {
                $image = $request->file('image');
                $upload = 'userProfile/';
                $filename = time() . $image->getClientOriginalName();
                $path    = move_uploaded_file($image->getPathName(), $upload . $filename);
                $user->image_url = $upload . $filename;
            }
            $user->description = $request->description;
            $result = $user->update();
            if ($result) {
                return response()->json(['data' => $result, 'message' => null, 'success' => true, 'status' => 200], 200);
            } else {
                return response()->json(['data' => null, 'message' => "profile not update", 'success' => false, 'status' => 403], 200);
            }
        } else {
            return response()->json('Login First!');
        }
    }
    public function company(Request $request)
    {
        $search = [];
        if (isset($request->industry) && $request->industry != 'all') {
            $search[] = ['industry_id', $request->industry];
        }
        if (isset($request->city) && $request->city != 'all') {
            $search[] = ['city_id', $request->city];
        }
        $companies = User::with('city', 'userRating', 'userType', 'products', 'userPackage', 'reviews')
            ->where('email', '!=', 'admin@gmail.com')->where('status', '=', 1)->where($search)
            ->whereHas('products', function ($q) {
                $q->where('price', '>', 0);
            })->get();
        $compani = array();
        foreach ($companies as $company) {
            $rating = DB::table('reviews')
                ->where('user_product_id', '=', $company->id)->sum('rating');
            $countrating = DB::table('reviews')
                ->where('user_product_id', '=', $company->id)
                ->count();
            if ($rating >  '0' && $countrating > '0') {
                $userrating = $rating / $countrating;
            } else {
                $userrating = '0';
            }
            $products = array();
            foreach ($company->products as $product) {

                $products[] = [
                    "id"            =>  $product->id,
                    "user_id"       =>  $product->user_id,
                    "name"          =>  $product->name,
                    "price"         =>  $product->price,
                    "quality"       =>  $product->quality,
                    "size"          =>  $product->size,
                    "image_url"     =>  isset($product->image_url) ? url('/') . '/' . $product->image_url : null,
                    "description"   =>  $product->description,
                    "paid_users_id" =>  $product->paid_users_id,
                    "created_at"    =>  $product->created_at,
                    "updated_at"    =>  $product->updated_at,
                ];
            }
            $compani[] = [
                "id"                    => $company->id,
                "name"                  => $company->name,
                "verify"                  => $company->verify,
                "email"                 => $company->email,
                "status"                => $company->status,
                "email_verified_at"     => $company->email_verified_at,
                "password_without_hash" => $company->password_without_hash,
                "image_url"             => isset($company->image_url) ? url('/') . '/' . $company->image_url : null,
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
                "total_rating" => $countrating,
                "city_id"               => $company->city_id,
                "industry_id"           => $company->industry_id,
                "expiry_date"           => $company->expiry_date,
                "view"                  => $company->view,
                "brand_id"              => $company->brand_id,
                "description"           => $company->description,
                "created_at"            => $company->created_at,
                "updated_at"            => $company->updated_at,
                "products"              => $products,
                'usertype' => $company->usertype,
                'city' => $company->city

            ];
        }
        return response()->json($compani);
    }
    public function brickscompany()
    {
        $companies = User::with('city', 'userType', 'products', 'reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->where('industry_id', 1)->whereHas('products', function ($q) {
            $q->where('price', '>', 0);
        })->get();

        $compani = array();

        foreach ($companies as $company) {
            $rating = DB::table('reviews')
                ->where('user_product_id', '=', $company->id)->sum('rating');
            $countrating = DB::table('reviews')
                ->where('user_product_id', '=', $company->id)
                ->count();
            if ($rating >  '0' && $countrating > '0') {
                $userrating = $rating / $countrating;
            } else {
                $userrating = '0';
            }
            $products = array();
            foreach ($company->products as $product) {
                $products[] = [
                    "id"            =>  $product->id,
                    "user_id"       =>  $product->user_id,
                    "name"          =>  $product->name,
                    "price"         =>  $product->price,
                    "quality"       =>  $product->quality,
                    "size"          =>  $product->size,
                    "image_url"     =>  url('/') . '/' . $product->image_url,
                    "description"   =>  $product->description,
                    "paid_users_id" =>  $product->paid_users_id,
                    "created_at"    =>  $product->created_at,
                    "updated_at"    =>  $product->updated_at,
                ];
            }
            $reviews = array();
            foreach ($company->reviews as $review) {
                $reviews[] = [
                    "id"                =>  $review->id,
                    "rating"            =>  $review->rating,
                    "message"           =>  $review->message,
                    "image_url"         =>  url('/') . '/' . $review->image_url,
                    "user_product_id"   =>  $review->user_product_id,
                    "auth_user_id"      =>  $review->auth_user_id,
                    "created_at"        =>  $review->created_at,
                    "updated_at"        =>  $review->updated_at,
                ];
            }
            $compani[] = [
                "id"                    => $company->id,
                "name"                  => $company->name,
                "email"                 => $company->email,
                "status"                => $company->status,
                "email_verified_at"     => $company->email_verified_at,
                "password_without_hash" => $company->password_without_hash,
                "image_url"             => url('/') . '/' . $company->image_url,
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

                "products"              => $products,

            ];
        }
        return response()->json($compani);
    }
    public function marblecompany()
    {
        $companies = User::with('city', 'userType', 'products', 'reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->where('industry_id', '==', 2)->whereHas('products', function ($q) {
            $q->where('price', '>', 0);
        })->get();

        $compani = array();
        foreach ($companies as $company) {
            $rating = DB::table('reviews')
                ->where('user_product_id', '=', $company->id)->sum('rating');
            $countrating = DB::table('reviews')
                ->where('user_product_id', '=', $company->id)
                ->count();
            if ($rating >  '0' && $countrating > '0') {
                $userrating = $rating / $countrating;
            } else {
                $userrating = '0';
            }
            $products = array();
            foreach ($company->products as $product) {
                $products[] = [
                    "id"            =>  $product->id,
                    "user_id"       =>  $product->user_id,
                    "name"          =>  $product->name,
                    "price"         =>  $product->price,
                    "quality"       =>  $product->quality,
                    "size"          =>  $product->size,
                    "image_url"     =>  url('/') . '/' . $product->image_url,
                    "description"   =>  $product->description,
                    "paid_users_id" =>  $product->paid_users_id,
                    "created_at"    =>  $product->created_at,
                    "updated_at"    =>  $product->updated_at,
                ];
            }
            $reviews = array();
            foreach ($company->reviews as $review) {
                $reviews[] = [
                    "id"                =>  $review->id,
                    "rating"            =>  $review->rating,
                    "message"           =>  $review->message,
                    "image_url"         =>  url('/') . '/' . $review->image_url,
                    "user_product_id"   =>  $review->user_product_id,
                    "auth_user_id"      =>  $review->auth_user_id,
                    "created_at"        =>  $review->created_at,
                    "updated_at"        =>  $review->updated_at,
                ];
            }
            $compani[] = [
                "id"                    => $company->id,
                "name"                  => $company->name,
                "email"                 => $company->email,
                "status"                => $company->status,
                "email_verified_at"     => $company->email_verified_at,
                "password_without_hash" => $company->password_without_hash,
                "image_url"             => url('/') . '/' . $company->image_url,
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
                "products"              => $products,
            ];
        }
        return response()->json($compani);
    }
    public function userDetail(Request $request)
    {
        $user = User::findOrFail($request->company_id);
        $rating = DB::table('reviews')
            ->where('user_product_id', '=', $request->company_id)->sum('rating');
        $countrating = DB::table('reviews')
            ->where('user_product_id', '=', $request->company_id)
            ->count();
        if ($rating >  0) {
            $userrating = $rating / $countrating;
        } else {
            $userrating = 0;
        }

        $user_detail = User::with('userType', 'city', 'products', 'reviews', 'userPackage')->where('id', $request->company_id)->whereHas('products', function ($q) {
            $q->where('price', '>', 0);
        })->get();
        $users = array();
        foreach ($user_detail as $user) {
            $users[] = [
                "id"            =>  $user->id,
                "name"       =>  $user->name,
                "first_name"          =>  $user->first_name,
                "last_name"         =>  $user->last_name,
                "phone_no"       =>  $user->phone_no,
                "user_type"          =>  $user->user_type,
                "rating" => $userrating,
                'total_rating' => $countrating,
                "user_package"          =>  $user->user_package,
                "image_url"     =>  isset($user->image_url) ? url('/') . '/' . $user->image_url : null,
                "city_id"   =>  $user->city_id,
                "city"                  => $user->city,
                "userType"              => $user->userType,
                "userPackage"                  => $user->userPackage,
                "description" =>  $user->description,
                "created_at"    =>  $user->created_at,
                "updated_at"    =>  $user->updated_at,
                "website_link" => url('/') . '/package/' . $user->id
            ];
        }

        return response()->json(['user_detail' => $users]);
    }
    public function userProduct(Request $request)
    {
        $product = Product::where('user_id', $request->comapny_id)->get();

        $products = array();
        foreach ($product as $product) {
            $products[] = [
                "id"            =>  $product->id,
                "user_id"       =>  $product->user_id,
                "name"          =>  $product->name,
                "price"         =>  $product->price,
                "quality"       =>  $product->quality,
                "size"          =>  $product->size,
                "image_url"     =>  url('/') . '/' . $product->image_url,
                "description"   =>  $product->description,
                "paid_users_id" =>  $product->paid_users_id,
                "created_at"    =>  $product->created_at,
                "updated_at"    =>  $product->updated_at,
            ];
        }
        return response()->json(['userProduct' => $products]);
    }

    public function userImageRemarks(Request $request)
    {
        $ImageRemarks = RemarksImage::where('user_id', $request->comapny_id)->get();
        $remarkimages = array();
        foreach ($ImageRemarks as $image) {
            $remarkimages[] = [
                "id" =>  $image->id,
                "image_url" =>  url('/') . '/storage/app/public/' . $image->image_url,
                "user_id" =>  $image->user_id,
                "description" =>  $image->description,
                "created_at" =>  $image->created_at,
                "updated_at" =>  $image->updated_at,

            ];
        }
        return response()->json(['user_remarkimages' => $remarkimages]);
    }
    public function userVideoRemarks(Request $request)
    {
        $VideoRemarks = RemarksVideo::where('user_id', $request->company_id)->get();

        return response()->json(['user_remarkvideo' => $VideoRemarks]);
    }
    public function AddReview(Request $request)
    {

        $review = new Review;
        $review->rating = $request->rating;
        $review->message = $request->message;
        $review->user_product_id = $request->company_id;
        $review->auth_user_id = $request->user_id;
        // if ($request->has('image')) {

        //     $fileFolder = 'remarksImages';
        //     if (!Storage::exists($fileFolder)) {
        //         Storage::makeDirectory($fileFolder);
        //     }

        //     $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
        //     $imageRemarks->image_url = $imageUrl;
        // }

        $result = $review->save();
        if (!$result) {
            return response()->json('0');
        } else {
            return response()->json('1');
        }
    }
    public function ShowReview(Request $request)
    {
        $reviews = Review::with('reviewUser')->where('user_product_id', $request->company_id)->orderBy('id', 'DESC')->get();

        $revie = array();
        foreach ($reviews as $review) {
            $revie[] = [
                "id" =>  $review->id,
                "user_product_id" =>  $review->user_product_id,

                "user_id" =>  $review->auth_user_id,
                "reviewUser"  => [
                    "id"         => $review->reviewUser->id,
                    "name"       => $review->reviewUser->name,
                    "image_url"     =>  url('/') . '/' . $review->reviewUser->image_url,
                ],
                "message" =>  $review->message,
                "created_at" =>  $review->created_at,
                "updated_at" =>  $review->updated_at,

            ];
        }
        return response()->json(['reviews' => $revie]);
    }
    public function UserPhone(Request $request)
    {

        $phone = new UserPhone;
        $phone->user_id = $request->user_id;
        $phone->user_detail_id = $request->company_id;
        $result = $phone->save();
        if (!$result) {
            return response()->json('0');
        } else {
            return response()->json('1');
        }
    }
    public function Remarks()
    {
        $remarks = ClientReview::all();

        $remark = array();
        foreach ($remarks as $item) {
            $remark[] = [
                "id"            =>  $item->id,
                "name"          =>  $item->name,
                "type"         =>  $item->type,
                "description"       =>  $item->description,
                "image_url"     =>  url('/') . '/' . $item->image_url,
                "created_at"    =>  $item->created_at,
                "updated_at"    =>  $item->updated_at,
            ];
        }
        return response()->json(['data' => $remark, 'message' => null, 'success' => true, 'status' => 200], 200);
    }
    public function ConstructionVideo()
    {
        $videos = ConstructionVideo::orderBy('order_by', 'ASC')->get();

        return response()->json(['data' => $videos, 'message' => null, 'success' => true, 'status' => 200], 200);
    }
    public function getProfileApi(Request $request)
    {
        $users = User::find($request->user_id);
        $user1 = array();
        $user1[] = [
            "id" =>  $users->id,
            "name" =>  $users->name,
            "first_name" =>  $users->first_name,
            "last_name" =>  $users->last_name,
            "address" =>  $users->address,
            "email" =>  $users->email,
            "phone" =>  $users->phone_no,
            "description" =>  $users->description,
            "image_url" =>  isset($users->image_url) ? url('/') . '/' . $users->image_url : null,
            "city_id" =>  $users->city_id,
            "city" => $users->city
        ];
        return response()->json(['data' => $user1, 'message' => null, 'success' => true, 'status' => 200], 200);
    }
}
