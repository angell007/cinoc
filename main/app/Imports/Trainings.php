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

            if (request()->get('to') == 'Entrepreneurship') {

                if (isset($row[1])) {

                    if (is_numeric($row[9])) {
                        $excelDate = intval($row[9]);
                        $unixTimestamp = ($excelDate - 25569) * 86400;
                        $fechaLegible = Carbon::createFromTimestampUTC($unixTimestamp)->format('Y-m-d');
                    } else {
                        $fechaLegible = Carbon::createFromFormat('d/m/Y', $row[9])->format('Y-m-d');
                    }

                    if(!$this->id) dd('No hay id ');
                    
                    DB::table('participants')->insertGetId([
                        'name' =>  $row[0],
                        'identifier' => $row[1],
                        'email' => $row[2] ?? ' ',
                        'phone' => $row[3] ?? ' ',
                        'sexo' => $row[4],
                        'segmento' => $row[5],
                        'functional_area' => $row[6],
                        'rol' => $row[7],
                        'entrepreneurship_name' => $row[8] ?? 'No registrado',
                        'trainings_id' => $this->id,
                        'created_at' => $fechaLegible,
                    ]);

                }
            }

            if (request()->get('to') == 'Empresas') {

                if (isset($row[3])) {
                    if (is_numeric($row[0])) {

                        $excelDate = intval($row[0]);
                        $unixTimestamp = ($excelDate - 25569) * 86400;
                        $fechaLegible = Carbon::createFromTimestampUTC($unixTimestamp)->format('Y-m-d');

                    } else {

                        if ($this->contieneLetras($row[0])) {

                            $fechaLegible =  Carbon::createFromFormat('d-M-y', substr($row[0], 0, 8))->format('Y-m-d');

                        } else {
                            $fechaLegible =  Carbon::createFromFormat('d/m/Y H:i:s', $row[0]);
                        }

                    }
                }

                if (isset($row[3])) {
                    DB::table('participants')->insertGetId([
                        'name' =>  $row[1] ?? ' ' ,
                        'identifier' => $row[2] ?? ' ',
                        'funcionario' =>  $row[3] ?? ' ',
                        'cargo' =>  $row[4] ?? ' ',
                        'phone' => $row[5] ?? ' ',
                        'email' => $row[6] ?? ' ',
                        'status' => $row[7] ?? 'Culminó',
                        'trainings_id' => $this->id,
                        'created_at' => $fechaLegible,
                    ]);
                }
            }

            if (request()->get('to') != 'Entrepreneurship' && request()->get('to') != 'Empresas') {

                if (isset($row[0])) {

                    if (is_numeric($row[12])) {

                        $excelDate = intval($row[12]);
                        $unixTimestamp = ($excelDate - 25569) * 86400;
                        $fechaLegible = Carbon::createFromTimestampUTC($unixTimestamp)->format('Y-m-d');
                        // $fechaLegible = date("Y-m-d", $unixTimestamp);

                    } else {
                        $fechaLegible = Carbon::createFromFormat('d/m/Y H:i:s', $row[12])->format('Y-m-d');
                    }

                    $data = [
                        'email' => $row[0] ?? '',
                        'type_doc' => $row[1] ?? '',
                        'identifier' => $row[2] ?? '',
                        'name' =>  $row[3] . ' ' . $row[4],
                        'phone' => $row[5] ?? '',
                        'semester' => $row[6] ?? '',
                        'functional_area' => $row[7] ?? '',
                        'rol' => $row[8] ?? '',
                        'status' => $row[9] ?? 'Culminó',
                        'sexo' => $row[10] ?? '',
                        'segmento' => $row[11] ?? '',
                        'trainings_id' => $this->id,
                        'created_at' =>  $fechaLegible ,
                    ];

                    DB::table('participants')->insertGetId($data);

                }
            }

        } catch (\Exception $th) {
            dd([$th->getLine(), $th->getMessage(), $th->getLine(), $row]);
            return null; //
            // return "we can't upload the id card numbers, please contact with support";
        }
    }

    public function contieneLetras($cadena)
    {
        return preg_match('/[a-zA-Z]/', $cadena);
    }
}
