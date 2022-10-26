<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_detailes;
use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:حذف مرفق', ['only' => ['destroy']]);
        
    }
    public function index($id)
    {
        echo "hello";
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_detailes  $invoices_detailes
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_detailes $invoices_detailes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_detailes  $invoices_detailes
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_detailes $invoices_detailes , $id)
    {
        $invoices = invoices::find($id);
        $details = invoices_detailes::where("id_Invoice" , $id)->get();
        $attachments =invoices_attachments::where("invoice_id" , $id)->get();
    
        return view('invoices.invoices_detailes' , compact('invoices' , 'details' , 'attachments'));
    }

    public function open_file($invoice_number , $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }
    public function get_file($invoice_number , $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($files);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_detailes  $invoices_detailes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_detailes $invoices_detailes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_detailes  $invoices_detailes
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_detailes $invoices_detailes , Request $request)
    {
        $invoices = invoices_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
