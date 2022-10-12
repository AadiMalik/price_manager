<?php

namespace App\Http\Controllers\Frontend;

use App\Brand;
use App\City;
use App\ConstructionVideo;
use App\Http\Controllers\Controller;
use App\Industry;
use App\User;
use App\ClientReview;
use App\UserType;
use App\Category;
use Illuminate\Http\Request;
use App\Conversation;
use App\EProduct;
use App\Message;
use App\Subscribe;
use App\Product;
use Auth;
use DB;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Kreait\Firebase\Auth\ApiClient;
use Kreait\Firebase\Auth\UserInfo;
use Kreait\Firebase\Auth\UserMetaData;
use Kreait\Firebase\Auth\UserRecord;
use Validator;

class HomeController extends Controller
{
  const FIREBASE_DATABSE_URI = 'https://fir-chat-e6185-default-rtdb.firebaseio.com';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('city', 'products','reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->orderBy('f_expiry', 'DESC')->whereHas('products', function($q)
        {
            $q->where('price','>', 0);

        })->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->withCount(['reviews as plus' => function ($query) {
            $query->select(\DB::raw('coalesce(count(rating))'));
        }])->orderByDesc('plus')->orderByDesc('average')->get();
        
        $new = User::orderBy('created_at','DESC')->with('city', 'products','reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->whereHas('products', function($q)
        {
            $q->where('price','>', 0);

        })->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->get();
        
        $brands = Brand::orderBy('name','ASC')->get();
        $cities = City::orderBy('name','ASC')->get();
        $industries = Industry::orderBy('name','ASC')->get();
        $category = Category::orderBy('name','ASC')->get();
        $reviews = ClientReview::all();
        $e_product = EProduct::orderBy('name','ASC')->get();
        $constructorVideos = ConstructionVideo::orderBy('order_by','ASC')->take(3)->get();
        return view('Frontend.home', compact('users','new', 'brands', 'constructorVideos', 'cities', 'category','industries','reviews','e_product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userSearch(Request $request)
    {
        $users = User::with('city', 'userRating', 'userType', 'products', 'userPackage' ,'reviews')->where('email', '!=', 'admin@gmail.com')->whereHas('products', function($q)
        {
            $q->where('price','>', 1);

        });
        // if ($request->city) {
        //     if ($request->city != 'all') {
        //         $users->where('city_id',$request->city);
        //     }else{
        //         $users->get();
        //     }
        // }
        // if ($request->industry) {
        //     if ($request->industry != 'all') {
        //         $users->where('industry_id',$request->industry);
        //     }else{
        //         $users->get();
        //     }
        // }

        
            $product = DB::table('products')->select('user_id')->distinct()->where('category_id',$request->user_type)->get();
            
                foreach($product as $item)
                {
                    if($request->user_type != 'all'){
                        $users->where('id',$item->user_id);
                    }
                    if ($request->industry != 'all') {
                        $users->where('id',$item->user_id)->where('industry_id',$request->industry);
                    }
                    if($request->city != 'all'){
                        $users->where('id',$item->user_id)->where('city_id',$request->city);
                    }
                }
            //  dd($users);

        
        $users = $users->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->orderByDesc('average')->get();

        return response()->json([
            'status' => 1,
            'data' => $users,
        ]);
        
        
        // $new = User::orderBy('created_at','DESC')->with('city', 'products','reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->whereHas('products', function($q)
        // {
        //     $q->where('price','>', 0);

        // })->withCount(['reviews as average' => function ($query) {
        //     $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        // }])->get();
        
        // $brands = Brand::orderBy('name','ASC')->get();
        // $cities = City::orderBy('name','ASC')->get();
        // $industries = Industry::orderBy('name','ASC')->get();
        // $category = Category::orderBy('name','ASC')->get();
        // $reviews = ClientReview::all();
        // $constructorVideos = ConstructionVideo::orderBy('order_by','ASC')->take(3)->get();
        // return view('Frontend.home', compact('users','new', 'brands', 'constructorVideos', 'cities', 'category','industries','reviews'));
    }
    
    public function allUser(){
        $users = User::with('reviews')->where('email', '!=', 'admin@gmail.com')->orderBy('f_expiry', 'DESC')->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->orderByDesc('average')->get();
        return view('Frontend.user', compact('users')); 
    }

    public function userchatView($id){
        $user  = User::where('id','=',$id)->first();
        $conversation = Conversation::where(function ($query) use ($user) {
                $query->where('user_id_1', '=', Auth::user()->id)
                      ->where('user_id_2', '=', $user->id);
            })->orWhere(function ($query) use ($user) {
                $query->where('user_id_1', '=', $user->id)
                      ->where('user_id_2', '=', Auth::user()->id);
            })->first();

            
            if(!$conversation){
                $conversation = Conversation::create([
                    'user_id_1' => $user->id,
                    'user_id_2' => Auth::user()->id
                ]);
            }            
            $conversation_id = $conversation->id;
                
        return view('Backend/user/chat',compact('user', 'conversation_id'));
    }

    public function submitChat(Request $request){
        $conversation = Conversation::where('id', $request->conversation_id)->first();
        $message = $conversation->messages()->create([
            'user_id' => Auth::user()->id,
            'message'=> $request->message
        ]);
        $message = [
            'sender'=> Auth::user()->id,
            'text'=> $request->message,
            'time' => $request->time,
            'isRead' => 0,
        ];
        $factory = (new Factory)->withServiceAccount(base_path() . '/fir-chat-e6185-firebase-adminsdk-pf4xq-f1c3edcafc.json')->withDatabaseUri(self::FIREBASE_DATABSE_URI);
        $database = $factory->createDatabase();
        $database->getReference('suppliersChat/'.$conversation->id.'/messages/')->push($message);
        
        return 'sent';
        
    }
    
    public function subscribe(Request $request)
    {
        $validation = $request->validate(
            [
                'email' => 'required|unique:subscribes,email'
            ]
        );
            $subscribe = new Subscribe;
            $subscribe->email = $request->email;
            $subscribe->save();
            return back()->with("<script>alert('Thanks for subscribe!')</script>");
    }
}
