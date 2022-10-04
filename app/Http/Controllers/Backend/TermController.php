<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Term;
use Illuminate\Http\Request;
use Validator;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term = Term::all();

        return view('Backend.term.index',compact('term'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.term.create');
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
            'heading' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $term = new Term;
            $term->heading = $request->heading;
            $term->description = $request->description;
            $term->urdu = $request->urdu;
            
            \LogActivity::addToLog("Term $ Condition Store");
            $term->save();

            return redirect()->route('indexterm')->with('success', 'Term & Condition added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        return view('Backend.term.edit',compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            
            $term->heading = $request->heading;
            $term->description = $request->description;
            $term->urdu = $request->urdu;
            \LogActivity::addToLog("Term & Condition Update id:{$term->id}");
            $term->update();

            return redirect()->route('indexterm')->with('success', 'Term & Condition Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
            \LogActivity::addToLog("Term & Condition Delete id:{$term->id}");
        $term->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Term & Condition deleted successfully'
        ]);
    }
}
