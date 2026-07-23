<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportParticipantToTraining implements ToModel
{
    public $id;
    public $to;

    public function __construct($id, $to)
    {
        $this->id = $id;
        $this->to = $to;
    }
    public function model(array $row)
    {

        try {

            if ($this->to == 'Entrepreneurship') {

                if (isset($row[1])) {

                    if (is_numeric($row[9])) {
                        $excelDate = intval($row[9]);
                        $unixTimestamp = ($excelDate - 25569) * 86400;
                        $fechaLegible = Carbon::createFromTimestampUTC($unixTimestamp)->format('Y-m-d');
                    } else {
                        $fechaLegible = Carbon::createFromFormat('d/m/Y H:i:s', $row[9])->format('Y-m-d');
                    }

                    DB::table('participants')->insertGetId([
                        'name' =>  $row[0],
                        'identifier' => $row[1],
                        'email' => $row[2] ?? ' ',
                        'phone' => $row[3] ?? ' ',
                        'sexo' => $row[4],
                        'segmento' => $row[5],
                        'functional_area' => $row[6],
                        'rol' => $row[7],
                        'entrepreneurship_name' => $row[8],
                        'trainings_id' => $this->id,
                        // 'created_at' => Carbon::now()->format('Y-m-d'),
                        'created_at' => $fechaLegible,
                        // 'created_at' => Carbon::createFromFormat('d/m/Y', Carbon::now())->format('Y-m-d'),
                    ]);

                }
            }

            if ($this->to == 'Empresas') {
                if (isset($row[5])) {
                    DB::table('participants')->insertGetId([
                        'name' =>  $row[2],
                        'identifier' => $row[4],
                        'funcionario' =>  $row[5],
                        'cargo' =>  $row[6],
                        'phone' => $row[7],
                        'email' => $row[8] ?? ' ',
                        'status' => $row[9] ?? 'Culminó',
                        'trainings_id' => $this->id,
                        'created_at' => Date::excelToDateTimeObject($row[0])->format('Y-m-d'),

                        // 'created_at' => Carbon::createFromFormat('d/m/Y', $row[0])->format('Y-m-d'),
                    ]);
                }
            }

            if ($this->to != 'Entrepreneurship' && $this->to != 'Empresas') {

                if (isset($row[0])) {

                    $posibles_formatos = ['Y-m-d', 'd/m/Y H:i:s', 'd-M-y'];


                    if (is_numeric($row[12])) {

                        $excelDate = intval($row[12]);
                        $unixTimestamp = ($excelDate - 25569) * 86400;
                        $fechaLegible = Carbon::createFromTimestampUTC($unixTimestamp)->format('Y-m-d');

                    } else {

                        if ($this->contieneLetras($row[12])) {
                            $fechaLegible =  Carbon::createFromFormat('d-M-y', $row[12])->format('Y-m-d');
                        } else {
                            $fechaLegible =  Carbon::createFromFormat('d/m/Y H:i:s', $row[12]);
                        }

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
