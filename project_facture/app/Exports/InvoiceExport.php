<?php

namespace App\Exports;

use App\Models\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Facades\Excel;

class InvoiceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return invoices::select('invoice_number',
         'invoice_Date',
         'Due_date',
         'product',
         'section_id',
         'Amount_collection',
         'Amount_Commission',
         'Discount',
         'Value_VAT',
         'Rate_VAT',
         'Total',
         'Status',
         'Value_Status',
         'note',
         'Payment_Date',)->get();
    }
}
