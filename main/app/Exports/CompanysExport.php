<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;

use App\Company;

use Carbon\Carbon;



class CompanysExport implements FromView, ShouldAutoSize

{
    public function __construct()
    {
    }

    public function view(): View

    {
        $today = Carbon::now();
        $companies = Company::all();
        return view('export.companys', ['data' => $companies]);
    }
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function (AfterSheet $event) {
    //             $cellRange = 'A1:W1'; // All headers
    //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
    //         },
    //     ];
    // }
}
