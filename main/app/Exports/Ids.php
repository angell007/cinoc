<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class Ids implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return DB::table('idcards_numbers')->select('id_number as Documento')->get();
    }
    
    
     public function headings(): array
    {
        return ["Documentos"];
    }
}
