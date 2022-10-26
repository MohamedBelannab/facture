<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // lastes user 

        $lastUser = User::orderBy('id' , 'DESC')->paginate(5);
        $lastInvoice = invoices::orderBy('id' , 'DESC')->paginate(5);
        $userOwner = User::where('roles_name' , '["owner"]')->get();
        $user = User::get();

        $count_all =invoices::count();
        $count_invoices1 = invoices::where('Value_Status', 1)->count();
        $count_invoices2 = invoices::where('Value_Status', 2)->count();
        $count_invoices3 = invoices::where('Value_Status', 3)->count();

        if($count_invoices2 == 0){
            $nspainvoices2=0;
        }
        else{
            $nspainvoices2 = $count_invoices2/ $count_all*100;
        }
  
        if($count_invoices1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_invoices1/ $count_all*100;
        }

        if($count_invoices3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_invoices3/ $count_all*100;
        }
  

        $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
        ->datasets([
            [
                'backgroundColor' => ['#f85d76', '#33c395','#f2904c'],
                'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
            ]
        ])
        ->options([]);
        $chartjsBar = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 350, 'height' => 200])
        ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
        ->datasets([
            [
                "label" => "االغير المدفوعة",
                'backgroundColor' => ['#f85d76'],
                'data' => [$nspainvoices2]
            ],
            [
                "label" => "المدفوعة",
                'backgroundColor' => ['#33c395'],
                'data' => [$nspainvoices1]
            ],
            [
                "label" => "المدفوعة جزئيا",
                'backgroundColor' => ['#f2904c'],
                'data' => [$nspainvoices3]
            ],
         ])
         ->options([]);





        return view('home'  , compact('chartjs' , 'chartjsBar' , 'lastUser' , 'lastInvoice' , 'userOwner' , 'user'));
    }
}
