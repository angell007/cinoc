<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class Trainings implements ToModel
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function model(array $row)
    {
        try {

            if (request()->get('to') == 'Empresas') {
                if (isset($row[5])) {

                    DB::table('participants')->insertGetId([
                        'name' =>  $row[2],
                        'funcionario' =>  $row[4],
                        'cargo' =>  $row[5],
                        'email' => $row[1] ?? ' ',
                        'phone' => $row[6],
                        'identifier' => $row[3],
                        'trainings_id' => $this->id,
                        'status' => $row[7] ?? 'Culminó',
                        'created_at' => Carbon::parse($row[0])
                    ]);
                }
            } else {
                DB::table('participants')->insertGetId([
                    'name' =>  $row[3] . ' ' . $row[4],
                    'email' => $row[0], 'phone' => $row[5],
                    'identifier' => $row[2],
                    'trainings_id' => $this->id,
                    'semester' => $row[9],
                    'status' => $row[10]
                ]);
            }
        } catch (\Exception $th) {
            dd($th->getMessage());
            return null; //
            // return "we can't upload the id card numbers, please contact with support";
        }
    }
}
