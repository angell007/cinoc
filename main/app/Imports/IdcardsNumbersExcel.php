<?php

namespace App\Imports;

use App\Models\IdcardsNumber;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IdcardsNumbersExcel implements ToModel
{
    public function model(array $row)
    {
        try {
            if ($this->validateIdNumber($row[0])) {

                return new IdcardsNumber([
                    'id_number' => $row[0],
                ]);
            }
        } catch (\Exception $th) {
            return "we can't upload the id card numbers, please contact with support";
        }
    }

    public function validateIdNumber($id_number): bool
    {
        if (IdcardsNumber::firstWhere('id_number', $id_number)) {
            return false;
        }
        return true;
    }
}
