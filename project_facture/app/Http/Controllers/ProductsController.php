<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:المنتجات', ['only' => ['index']]);
        $this->middleware('permission:اضافة منتج', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل منتج', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف منتج', ['only' => ['destroy']]);

        
    }
    public function index()
    {
        $sections = section::all();
        $products = products::all();
        return view("product.products" , compact('sections' , 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Product_name' => 'required' ,
            'section_id' => 'required' ,
            'description' => 'required'
        ],[
            'Product_name.required' => 'يرجى ادخال اسم منتج' ,
            'section_id.required' => 'يرجى اختيار القسم' ,
            'description.required' => 'يرجى ادخال ملاحظات'
        ]);

        products::create([
            'Product_name' => $request->Product_name ,
            'section_id' =>  $request->section_id ,
            'description' => $request->description

        ]);

        session()->flash('add' , 'تم اضافة منتج بنجاح');
        return redirect('/products');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        $id = section::where('section_name', $request->section_name)->first()->id;

       $Products = products::findOrFail($request->pro_id);

       $Products->update([
       'Product_name' => $request->Product_name,
       'description' => $request->description,
       'section_id' => $id,
       ]);

       session()->flash('Edit', 'تم تعديل المنتج بنجاح');
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $products = products::find($request->pro_id) ;
        $products->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return back();

    }
}
