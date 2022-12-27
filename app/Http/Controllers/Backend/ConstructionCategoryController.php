<?php

namespace App\Http\Controllers\Backend;

use App\ConstructionCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConstructionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = ConstructionCategory::orderBy('name','ASC')->get();

        return view('Backend.construction_category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.construction_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'name' => $request->name,
                
            ];

            $category = ConstructionCategory::create($data);

            return redirect()->route('indexConstructionCategory')->with('success', 'Category added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ConstructionCategory::find($id);
        return view('Backend.construction_category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'name' => $request->name,
                
            ];

            $category = ConstructionCategory::find($id);
            $category->update($data);

            return redirect()->route('indexConstructionCategory')->with('success', 'Category update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConstructionCategory $category)
    {
        $category->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Category deleted successfully'
        ]);
    }
}
