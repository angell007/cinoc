<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

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
            switch ($this->to) {
                case 'Entrepreneurship':
                    $this->importEntrepreneurship($row);
                    break;
                case 'Empresas':
                    $this->importEmpresas($row);
                    break;
                default:
                    $this->importDefault($row);
                    break;
            }
        } catch (\Exception $th) {
            Log::warning('No se pudo importar un participante de capacitación', [
                'line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);
            return null;
        }
    }

    private function importEntrepreneurship($row)
    {
        if (isset($row[1])) {
            $fechaLegible = $this->getFechaLegible($row[9]);
            DB::table('participants')->insertGetId([
                'name' => $row[0],
                'identifier' => $row[1],
                'email' => $row[2] ?? ' ',
                'phone' => $row[3] ?? ' ',
                'sexo' => $row[4],
                'segmento' => $row[5],
                'functional_area' => $row[6],
                'rol' => $row[7],
                'entrepreneurship_name' => $row[8],
                'trainings_id' => $this->id,
                'created_at' => $fechaLegible,
            ]);
        }
    }

    private function importEmpresas($row)
    {
        if (isset($row[5])) {
            DB::table('participants')->insertGetId([
                'name' => $row[2],
                'identifier' => $row[4],
                'funcionario' => $row[5],
                'cargo' => $row[6],
                'phone' => $row[7],
                'email' => $row[8] ?? ' ',
                'status' => $row[9] ?? 'Culminó',
                'trainings_id' => $this->id,
                'created_at' => $this->getFechaLegible($row[0]),
            ]);
        }
    }

    private function importDefault($row)
    {
        if (isset($row[0])) {
            $fechaLegible = $this->getFechaLegible($row[12]);
            DB::table('participants')->insertGetId([
                'email' => $row[0] ?? '',
                'type_doc' => $row[1] ?? '',
                'identifier' => $row[2] ?? '',
                'name' => $row[3] . ' ' . $row[4],
                'phone' => $row[5] ?? '',
                'semester' => $row[6] ?? '',
                'functional_area' => $row[7] ?? '',
                'rol' => $row[8] ?? '',
                'status' => $row[9] ?? 'Culminó',
                'sexo' => $row[10] ?? '',
                'segmento' => $row[11] ?? '',
                'trainings_id' => $this->id,
                'created_at' => $fechaLegible,
            ]);
        }
    }

    private function getFechaLegible($date)
    {
        if (is_numeric($date)) {
            $excelDate = intval($date);
            $unixTimestamp = ($excelDate - 25569) * 86400;
            return Carbon::createFromTimestampUTC($unixTimestamp)->format('Y-m-d');
        }

        try {
            $format = $this->contieneLetras($date) ? 'd-M-y H:i:s' : 'd/m/Y H:i:s';
            return Carbon::createFromFormat($format, $date)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::warning("No se pudo parsear la fecha: $date. Usando la fecha actual.");
            return Carbon::now()->format('Y-m-d');
        }
    }

    public function contieneLetras($cadena)
    {
        return preg_match('/[a-zA-Z]/', $cadena);
    }
}
