<?php

namespace App\Http\Controllers\Frontend;

use App\Brand;
use App\Cart;
use App\City;
use App\ConstructionVideo;
use App\Http\Controllers\Controller;
use App\Industry;
use App\User;
use App\ClientReview;
use App\UserType;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use App\Conversation;
use App\EProduct;
use App\Message;
use App\PriceCategory;
use App\PriceProduct;
use App\PriceTable;
use App\Subscribe;
use App\Product;
use App\ProductCategory;
use Auth;
use Carbon\Carbon;
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
        $users = User::with('city', 'products', 'reviews')->where('user_type', '!=', 1)->where('user_type', '!=', 2)->where('status', '=', 1)->orderBy('f_expiry', 'DESC')->whereHas('products', function ($q) {
            $q->where('price', '>', 0);
        })->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->withCount(['reviews as plus' => function ($query) {
            $query->select(\DB::raw('coalesce(count(rating))'));
        }])->orderByDesc('plus')->orderByDesc('average')->get();

        $new = User::orderBy('created_at', 'DESC')->with('city', 'products', 'reviews')->where('user_type', '!=', 1)->where('status', '=', 1)->where('user_type', '!=', 2)->whereHas('products', function ($q) {
            $q->where('price', '>', 0);
        })->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->get();

        $brands = Brand::orderBy('name', 'ASC')->get();
        $cities = DB::table('users')
            ->join('cities', 'cities.id', 'users.city_id')
            ->select('cities.id', 'cities.name')
            ->where('users.user_type', '!=', 1)
            ->where('users.user_type', '!=', 2)
            ->where('users.status', '=', 1)
            ->groupBy('users.city_id', 'cities.id', 'cities.name')
            ->get();
        $industries = DB::table('users')
            ->join('industries', 'industries.id', 'users.industry_id')
            ->select('industries.id', 'industries.name')
            ->where('users.user_type', '!=', 1)
            ->where('users.user_type', '!=', 2)
            ->where('users.status', '=', 1)
            ->groupBy('users.industry_id', 'industries.id', 'industries.name')
            ->get();
        // $cities = City::orderBy('name', 'ASC')->get();
        // $industries = Industry::orderBy('name', 'ASC')->get();
        $category = Category::orderBy('name', 'ASC')->get();
        $reviews = ClientReview::all();
        $e_product = EProduct::orderBy('name', 'ASC')->get();
        $comment = Comment::orderBy('created_at', 'DESC')->where('status', 0)->get();
        $category = ProductCategory::orderBy('name', 'ASC')->get();
        $constructorVideos = ConstructionVideo::orderBy('order_by', 'ASC')->take(3)->get();
        $price_category = PriceCategory::orderBy('created_at', 'ASC')->get();
        return view('Frontend.home', compact(
            'users',
            'new',
            'brands',
            'constructorVideos',
            'cities',
            'category',
            'industries',
            'reviews',
            'e_product',
            'category',
            'comment',
            'price_category'
        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PriceTable($category_id)
    {
        $product = PriceProduct::where('category_id',$category_id)->get();
        $category = PriceCategory::find($category_id);
        $city = PriceTable::select('city_id')->where('category_id',$category_id)->groupBy('city_id')->get();
        $priceTable=[];
        $products=[];
        foreach ($product as $key => $item) {
            $products[]=[
                "name"=>$item->name
            ];

        }
        foreach ($city as $key => $item) {
            $city_name= City::find($item->city_id);
            $priceTable[]=[
                "name"=>$city_name->name,
                "price"=>PriceTable::where('category_id',$category_id)->where('city_id',$item->city_id)->get()
            ];
        }
        $data=[
            "date"=>Carbon::now()->format('d M Y'),
            "category"=>$category,
            "products"=>$products,
            "priceTable"=>$priceTable
        ];
        return response()->json($data);
    }
    public function Cart(Request $request)
    {
        $check = Cart::where('user_id', Auth()->user()->id)->where('product_id', $request->product_id)->first();
        if ($check != null) {
            $check->qty = $check->qty + 1;
            $check->update();
            return back();
        } else {
            $cart = new Cart;
            $cart->user_id = Auth()->user()->id;
            $cart->product_id = $request->product_id;
            $cart->save();
            return back();
        }
    }
    public function detailCart(Request $request)
    {
        $check = Cart::where('user_id', Auth()->user()->id)->where('product_id', $request->product_id)->first();
        if ($check != null) {
            $check->qty = $check->qty + $request->qty;
            $check->update();
        } else {
            $cart = new Cart;
            $cart->user_id = Auth()->user()->id;
            $cart->product_id = $request->product_id;
            $cart->qty = $request->qty;
            $cart->save();
        }
        if ($request->add == 'buy') {
            return redirect('cart');
        } else {
            return redirect('cart');
        }
    }
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
        $users = User::with('city', 'userRating', 'userType', 'products', 'userPackage', 'reviews')->where('email', '!=', 'admin@gmail.com')->where('status', '=', 1)->whereHas('products', function ($q) {
            $q->where('price', '>', 1);
        });
        // $product = DB::table('products')->select('user_id')->distinct()->where('category_id', $request->user_type)->get();
        // if(isset($product)){
        // foreach ($product as $item) {
        //     if ($request->user_type != 'all') {
        //         $users->where('id', $item->user_id);
        //     }
        //     if ($request->industry != 'all') {
        //         $users->where('industry_id', $request->industry);
        //     }
        //     if ($request->city != 'all') {
        //         $users->where('city_id', $request->city);
        //     }
        // }
        // }else{
        if ($request->industry != 'all') {
            $users->where('industry_id', $request->industry);
        }
        if ($request->city != 'all') {
            $users->where('city_id', $request->city);
        }
        // }
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

    public function allUser()
    {
        $users = User::with('reviews')->where('email', '!=', 'admin@gmail.com')->where('status', '=', 1)->orderBy('f_expiry', 'DESC')->withCount(['reviews as average' => function ($query) {
            $query->select(\DB::raw('coalesce(avg(rating), 0)'));
        }])->orderByDesc('average')->get();
        return view('Frontend.user', compact('users'));
    }

    public function userchatView($id)
    {
        $user  = User::where('id', '=', $id)->first();
        $conversation = Conversation::where(function ($query) use ($user) {
            $query->where('user_id_1', '=', Auth::user()->id)
                ->where('user_id_2', '=', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_id_1', '=', $user->id)
                ->where('user_id_2', '=', Auth::user()->id);
        })->first();


        if (!$conversation) {
            $conversation = Conversation::create([
                'user_id_1' => $user->id,
                'user_id_2' => Auth::user()->id
            ]);
        }
        $conversation_id = $conversation->id;

        return view('Backend/user/chat', compact('user', 'conversation_id'));
    }

    public function submitChat(Request $request)
    {
        $conversation = Conversation::where('id', $request->conversation_id)->first();
        $message = $conversation->messages()->create([
            'user_id' => Auth::user()->id,
            'message' => $request->message
        ]);
        $message = [
            'sender' => Auth::user()->id,
            'text' => $request->message,
            'time' => $request->time,
            'isRead' => 0,
        ];
        $factory = (new Factory)->withServiceAccount(base_path() . '/fir-chat-e6185-firebase-adminsdk-pf4xq-f1c3edcafc.json')->withDatabaseUri(self::FIREBASE_DATABSE_URI);
        $database = $factory->createDatabase();
        $database->getReference('suppliersChat/' . $conversation->id . '/messages/')->push($message);

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
