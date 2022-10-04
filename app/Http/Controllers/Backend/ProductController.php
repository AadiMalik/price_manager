<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Validator;
use Storage;
use File;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminMail = auth()->user()->email;
        if ($adminMail == "admin@gmail.com") {
            $products = Product::with('category_name')->where('user_id',1)->get();
        } else {
            $products = Product::with('category_name')->where('user_id', auth()->user()->id)->get();
        }

        return view('Backend.product.index', compact('products'));
    }
    public function user_product(){
            $products = Product::with('category_name')->where('user_id','!=',1)->get();

        return view('Backend.product.user_product', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('name','ASC')->get();
        return view('Backend.product.create',compact('category'));
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
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'oldprice' => 'numeric|gt:0',
            'quality' => 'required',
            'size' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $product = new Product;
            $product->user_id = auth()->user()->id;
            $product->name = ucwords($request->name);
            $product->price = $request->price;
            $product->pre_price = $request->oldprice;
            $product->category_id = $request->category;
            $product->quality = $request->quality;
            $product->size = $request->size;
            $product->description = $request->description;
            $product->paid_users_id = json_encode(auth()->user()->id);

if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'userProduct/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $product->image_url = $upload.$filename;
            }
//             if ($request->has('image')) {
//                 $fileFolder = 'userProduct';
// //
//                 if (!Storage::exists($fileFolder)) {
//                     Storage::makeDirectory($fileFolder);
//                 }

//                 $imageUrl = Storage::disk('public')->putFile($fileFolder, $request->image);
//                 $data['image_url'] = $imageUrl;
//             }
            $product->save();
            \LogActivity::addToLog("Product Created");
            return redirect()->route('indexProduct')->with('success', 'Product added Successfully');
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
    public function edit(Product $product)
    {
        if ($product->user_id != auth()->user()->id) {
            return redirect()->route('home')->with('error','You are not edit this.');
        }
        $category = Category::orderBy('name','ASC')->get();
        return view('Backend.product.edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        if ($product->user_id != auth()->user()->id) {
            return redirect()->route('home')->with('error','You are not update this.');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'quality' => 'required',
            'size' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $product->user_id = auth()->user()->id;
            $product->name = ucwords($request->name);
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->pre_price = $request->oldprice;
            $product->quality = $request->quality;
            $product->size = $request->size;
            $product->description = $request->description;
            
            

            if($request->hasfile('image')){
            $image = $request->file('image');
            $upload = 'userProduct/';
            $filename = time().$image->getClientOriginalName();
            $path    = move_uploaded_file($image->getPathName(), $upload.$filename);
                $product->image_url = $upload.$filename;
            }
            $product->update();
            \LogActivity::addToLog("Product Updated");

            return redirect()->route('indexProduct')->with('success', 'Product update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->user_id != auth()->user()->id && auth()->user()->id != '1') {
            
            return redirect()->route('home')->with('error','You are not delete this.');
        }
        if ($product->image_url) {
            if(File::exists('storage/app/public/'.$product->image_url)) {
                File::delete('storage/app/public/'.$product->image_url);
            }
           Storage::delete($product->image_url);
        }
        \LogActivity::addToLog("Product Deleted id:{$product->id}");
        $product->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function defaultProductIndex () {
        $adminProducts = Product::with('category_name')->where('user_id',1)->get();
    
        return view('Backend.product.adminProduct',compact('adminProducts'));
    }

    public function addAdminProduct(Product $product) {
        $paidUserIds = explode(',',$product->paid_users_id);
        array_push($paidUserIds,auth()->user()->id);
        $changeInString = implode(',' ,$paidUserIds);

        $product->paid_users_id = str_replace('~[\\\\/:*?"<>|]~',',' ,$changeInString);
        $product->save();
            $data['image_url'] = $product->image_url;
        
        $adminToUserProductConvert = new Product();
        $adminToUserProductConvert->name = $product->name;
        $adminToUserProductConvert->price = $product->price;
        $adminToUserProductConvert->category_id = $product->category_id;
        $adminToUserProductConvert->pre_price = $product->pre_price;
        $adminToUserProductConvert->quality = $product->quality;
        $adminToUserProductConvert->size = $product->size;
        $adminToUserProductConvert->image_url =  $data['image_url'];
        $adminToUserProductConvert->description = $product->description;
        $adminToUserProductConvert->user_id = auth()->user()->id;
        \LogActivity::addToLog("Default Product Store id:{$product->id}");
        $adminToUserProductConvert->save();


        return redirect()->route('defaultProductIndex')->with('success', 'Product add in your products Successfully');

    }
}


?>