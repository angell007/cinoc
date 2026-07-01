<?php

namespace App\Imports;

use App\Models\SendedCvs;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSendedCvsExcel implements ToModel
{
    public function model(array $row)
    {
        try {
            return new SendedCvs([
                'date' => $row[0],
                'company' => $row[1],
                'position' => $row[2],
                'name' => $row[3],
                'id_number' => $row[4],
                'programa' => $row[5],
                'email' => $row[6],
                'contacto' => $row[7],
                'rol' => $row[8],
                'gender' => $row[9],
                'segmento' => $row[10]
            ]);

        } catch (\Exception $th) {
            return "we can't upload the id card numbers, please contact with support";
        }
    }
}
