<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\RemarksImage;
use App\RemarksVideo;
use App\Review;
use App\User;
use App\Industry;
use App\UserPhone;
use App\Product;
use App\Category;
use App\UserPackage;
use Illuminate\Http\Request;
use Validator;
use Storage;
use DB;
use App\SliderImage;
class PackageController extends Controller
{
    public function showPackage () {
        $packages = UserPackage::all();

        return view('Frontend.package',compact('packages'));
    }

    public function packageDetail ($user) {
        $user = User::findOrFail($user);
        $view = $user->view ? $user->view + 1 : 1 ;
        $user->view = $view;
        $user->save();
        $videoRemarks = RemarksVideo::where('user_id',$user->id)->paginate(8);
        $imageRemarks = RemarksImage::where('user_id',$user->id)->get();
        $product = Product::where('user_id',$user->id)->orderBy('name','ASC')->get();
        $slider_images = SliderImage::where('user_id',$user->id)->get();
        $reviews = Review::where('user_product_id',$user->id)->paginate(15);
        $data = DB::table('user_images')
               ->where('user_id',$user->id)->get();
               
        $category = Category::orderBy('name','ASC')->get();
        $productcategory = DB::table('products')->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.id', 'categories.name')->orderBy('categories.name','ASC')->where('user_id',$user->id)->distinct()->get();
            // dd($productcategory);
        // $productcategory = DB::table('products')->select('category_id')->orderBy('category_id','ASC')->where('user_id',$user->id)->distinct()->get();
               
        $users = User::inRandomOrder()->with('city', 'products','reviews')->where('id', '!=', $user->id)->where('user_type', '!=', 1)->where('status', '=', 1)->where('user_type', '!=', 2)->whereHas('products', function($q)
        {
            $q->where('price','>', 0);

        })->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->withCount(['reviews as plus' => function ($query) {
            $query->select(\DB::raw('coalesce(count(rating))'));
        }])->orderByDesc('plus')->orderByDesc('average')->get();
        return view('Frontend.productDetail',compact('user','users','product','category','productcategory','videoRemarks','imageRemarks','reviews','data','slider_images'));
    }
        public function getProduct($id,$category){
            $user = User::findOrFail($id);
        $videoRemarks = RemarksVideo::where('user_id',$id)->paginate(8);
        $imageRemarks = RemarksImage::where('user_id',$id)->get();
        if($category=='0'){
            $product = Product::where('user_id',$id)->orderBy('name','ASC')->get();
        }else{
        $product = Product::where('user_id',$id)->where('category_id',$category)->orderBy('name','ASC')->get();
        }
        $slider_images = SliderImage::where('user_id',$id)->get();
        $reviews = Review::where('user_product_id',$id)->paginate(15);
        $data = DB::table('user_images')
               ->where('user_id',$id)->get();
        $category = Category::orderBy('name','ASC')->get();
        $productcategory = DB::table('products')->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.id', 'categories.name')->orderBy('categories.name','ASC')->where('user_id',$user->id)->distinct()->get();
               
        $users = User::inRandomOrder()->with('city', 'products','reviews')->where('id', '!=', $id)->where('user_type', '!=', 1)->where('status', '=', 1)->where('user_type', '!=', 2)->whereHas('products', function($q)
        {
            $q->where('price','>', 0);

        })->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->withCount(['reviews as plus' => function ($query) {
            $query->select(\DB::raw('coalesce(count(rating))'));
        }])->orderByDesc('plus')->orderByDesc('average')->get();
        return view('Frontend.productDetail',compact('user','users','product','category','productcategory','videoRemarks','imageRemarks','reviews','data','slider_images'));
      }
    public function packageReview(Request $request,User $user)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'message' => 'max:1000',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $review = new Review;
            $review->rating = $request->rating;
            $review->message = $request->message;
            $review->user_product_id = $user->id;
            $review->auth_user_id = auth()->user()->id;
            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'review/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
            $review->image_url = $filename;
        }
            

            $review->save();

            return redirect()->back()->with('success', 'Review added Successfully');
        }
    }

    public function ClickPhone (Request $request)
    {
    //     $user = User::findOrFail($user);
    //     if($user->id != Auth()->user()->id){
    //         $phone = new UserPhone;
    //         $phone->user_id = Auth()->user()->id;
    //         $phone->user_detail_id = $user->id;
            
    //         $phone->save();
    //         return redirect()->back()->with('message', '');
    // }
    //          return redirect()->back();
    
        UsePhone::create($request->all());
        return json_encode(array(
            "statusCode"=>200
        ));
    }
}
