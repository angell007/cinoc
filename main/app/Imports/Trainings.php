<?php

namespace App\Imports;

use App\Models\IdcardsNumber;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class Trainings implements ToModel
{
    
    public $id ;
    
    public function __construct($id){
        $this->id = $id ;
    }
    
    public function model(array $row)
    {
        
        try {
            
            // if ($this->validateIdNumber($row[0])) {
            
                    $id = DB::table('participants')->insertGetId([
                        'name' =>  $row[3] .' '. $row[4],
                        'email' => $row[0],
                        'phone' => $row[5],
                        'identifier' => $row[2],
                        'trainings_id' => $this->id,
                        'semester' => $row[9],
                        'status' => $row[10]
                    ]);
            // }
            
        } catch (\Exception $th) {
            return "we can't upload the id card numbers, please contact with support";
        }
    }

    public function validateIdNumber($id_number): bool
    {
        // if (IdcardsNumber::firstWhere('id_number', $id_number)) {
        //     return false;
        // }
        // return true;
    }
}
