<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:الاقسام', ['only' => ['index']]);
        $this->middleware('permission:اضافة قسم', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
        
    }
    public function index()
    {
        $section = section::all();
        return view("section.section" , compact("section"));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required'
        ],[
            "section_name.required" => "يرجي ادخال اسم القسم",
            "section_name.unique" => "اسم القسم مسجل مسبقا",
            "description.required" => "يرجى ادخال الوصف"
        ]);

            section::create([
                'section_name' => $request->section_name ,
                'description' => $request->description ,
                'created_by' => (Auth::user()->name)
            ]);

            session()->flash("add" , 'تم اضافة قسم بنجاح');
            return redirect("/sections");
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id ;
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required'
            
        ],[
            "section_name.required" => "يرجي ادخال اسم القسم",
            "section_name.unique" => "اسم القسم مسجل مسبقا",
            "description.required" => "يرجى ادخال الوصف"

        ]);

        $section = section::find($id);
        $section->update([
            'section_name' => $request->section_name ,
            'description' => $request->description
        ]);

        session()->flash('edite' , 'تم تعديل القسم بنجاح');
        
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id ;
        $section = section::find($id) ;
        $section->delete();

        session()->flash('delete' ,'تم حذف القسم بنجاح' );
        return redirect('/sections');
    }
}
