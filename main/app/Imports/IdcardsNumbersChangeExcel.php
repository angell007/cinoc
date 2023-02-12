<?php

namespace App\Imports;

use App\Models\IdcardsNumber;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IdcardsNumbersChangeExcel implements ToModel
{
    public function model(array $row)
    {
        try {
            
            $this->validateIdNumber($row[0]);
            
        } catch (\Exception $th) {
            return "No hemos podido actualizar, por favor contacte con soporte";
        }
    }

    public function validateIdNumber($id_number)
    {
        $student = User::firstWhere('national_id_card_number', $id_number);
        
        if ($student) {
            
            $student->rol = 'Egresado';
            $student->save();
            
        }
    }
}
