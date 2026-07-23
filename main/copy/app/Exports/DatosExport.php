<?php

namespace App\Exports;

use App\User;
use App\Company;
use App\JobApply;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatosExport implements FromView
{
    private $date_init;
    private $date_end;

    public function __construct($date_init, $date_end)
    {
        $this->date_init = $date_init;
        $this->date_end = $date_end;
    }



    public function view(): View
    {
        try {

            $today = Carbon::parse($this->date_init);

            $this->date_init = Carbon::parse($this->date_init)->startOfDay();
            $this->date_end = Carbon::parse($this->date_end)->endOfDay();

            $company_registered = Company::where('created_at', 'Like', '%' . $today->format('Y-m') . '%')->count();

            $genders = DB::table('genders')->select('*')->where('lang', 'es')->get();
            $poblacions = DB::table('marital_statuses')->select('*')->where('lang', 'es')->get();



            $legens = [
                 'Registrados',
                 'Registrados de población',
                 'Número de Hojas de Vida Remitidas (Autopostulacion) ',
                 'Número de Hojas de Vida Remitidas (Autopostulacion) de población ',
                 'Número de Personas Colocadas ',
                 'Número de Personas colocadas con enfoque diferencial ',

                 'Número de Hojas de Vida Remitidas (Prestador) ',
                 'Número de Hojas de Vida Remitidas (Prestador) de población ',
                 'Personas atendidas en entrevista de orientación ocupacional ',
                 'Personas atendidas en actividades grupales de orientación ocupacional ',

            ];

            $results = [];

            $results[$legens[0] . ' ' . 'No data'] = User::whereNull("gender_id")->where('created_at', '>=', $this->date_init)->where('created_at', '<=', $this->date_end)->get();



            foreach ($genders as $gender) {
                $results[$legens[0] . ' ' . $gender->gender] = User::where("gender_id", $gender->gender_id)->where('created_at', '>=', $this->date_init)->where('created_at', '<=', $this->date_end)->get();
            }



            foreach ($genders as $gender) {
                foreach ($poblacions as $poblacion) {
                    $results[$legens[1] . ' ' . $gender->gender . ' ' . $poblacion->marital_status] = User::where("gender_id", $gender->gender_id)
                         ->where('marital_status_id', $poblacion->marital_status_id)
                         ->where('created_at', '>=', $this->date_init)
                         ->where('created_at', '<=', $this->date_end)->get();
                }

                $results[$legens[1] . ' ' . $gender->gender . ' No data'] = User::where("gender_id", $gender->gender_id)
                     ->whereNull('marital_status_id')->where('created_at', '>=', $this->date_init)
                     ->where('created_at', '<=', $this->date_end)->get();
            }


            $mainQuery = JobApply::join("users", "users.id", "=", "job_apply.user_id")
                 ->join("jobs", "jobs.id", "=", "job_apply.job_id")
                 ->where('jobs.is_pl', 0);

            foreach ($genders as $gender) {
                $results[$legens[2] . ' ' . $gender->gender] = $mainQuery->where("users.gender_id", $gender->gender_id)
                     ->where('job_apply.updated_at', '>=', $this->date_init)
                     ->where('job_apply.updated_at', '<=', $this->date_end)
                     ->where('status', 'espera')->get();
            }


            foreach ($genders as $gender) {
                foreach ($poblacions as $poblacion) {
                    $results[$legens[3] . ' ' . $gender->gender . ' ' . $poblacion->marital_status] = $mainQuery->where("users.gender_id", $gender->gender_id)
                         ->where('users.marital_status_id', $poblacion->marital_status_id)
                         ->where('job_apply.updated_at', '>=', $this->date_init)
                         ->where('job_apply.updated_at', '<=', $this->date_end)
                         ->where('status', 'espera')->get();
                }

                $results[$legens[3] . ' ' . $gender->gender . ' No data '] = $mainQuery->where("users.gender_id", $gender->gender_id)
                     ->whereNull('users.marital_status_id')
                     ->where('job_apply.updated_at', '>=', $this->date_init)
                     ->where('job_apply.updated_at', '<=', $this->date_end)
                     ->where('status', 'espera')->get();
            }


            foreach ($genders as $gender) {

                $results[$legens[4] . ' ' . $gender->gender] = $mainQuery->where("job_apply.status", "=", "contratado")
                     ->where("users.gender_id", $gender->gender_id)
                     ->where('job_apply.updated_at', '>=', $this->date_init)
                     ->where('job_apply.updated_at', '<=', $this->date_end)
                     ->where('status', 'contratado')->get();
            }


            foreach ($genders as $gender) {
                foreach ($poblacions as $poblacion) {
                    $results[$legens[5] . ' ' . $gender->gender . ' ' . $poblacion->marital_status] = $mainQuery->where("job_apply.status", "=", "contratado")
                         ->where("users.gender_id", $gender->gender_id)
                         ->where('users.marital_status_id', $poblacion->marital_status_id)
                         ->where('job_apply.updated_at', '>=', $this->date_init)
                         ->where('job_apply.updated_at', '<=', $this->date_end)
                         ->where('status', 'contratado')->get();
                }

                $results[$legens[5] . ' ' . $gender->gender . ' No data '] = $mainQuery->where("job_apply.status", "=", "contratado")
                     ->where("users.gender_id", $gender->gender_id)
                     ->whereNull('users.marital_status_id')
                     ->where('job_apply.updated_at', '>=', $this->date_init)
                     ->where('job_apply.updated_at', '<=', $this->date_end)
                     ->where('status', 'contratado')->get();
            }




            foreach ($genders as $gender) {

                $remitidos = DB::table('sended_cvs')
                    ->join('users', 'users.national_id_card_number', 'sended_cvs.id_number')
                    ->whereRaw("STR_TO_DATE(sended_cvs.date, '%d-%b-%y') >= '$this->date_init'")
                    ->whereRaw("STR_TO_DATE(sended_cvs.date, '%d-%b-%y') <= '$this->date_end' ")
                    ->where('gender', $gender->gender)
                    ->pluck('sended_cvs.id_number');

                $results[$legens[6] . ' ' . $gender->gender] = DB::table('sended_cvs')
                     ->whereIn('sended_cvs.id_number', $remitidos)
                     ->get();
            }


            $sexos = ['Hombre', 'Mujer'];

            foreach ($sexos as $gender) {

                $aux = DB::table('sended_cvs')
                            ->whereRaw("STR_TO_DATE(sended_cvs.date, '%d-%b-%y') >= '$this->date_init'")
                            ->whereRaw("STR_TO_DATE(sended_cvs.date, '%d-%b-%y') <= '$this->date_end' ")
                            ->where('gender', $gender);


                $remitidos = $aux->pluck('sended_cvs.id_number');
                $onsended_cvs = $aux->pluck('sended_cvs.id');


                foreach ($poblacions as $poblacion) {
                    $results[$legens[7] . ' ' . $gender . ' ' . $poblacion->marital_status] = DB::table('sended_cvs')
                    ->where('sended_cvs.segmento', $poblacion->marital_status)
                    ->whereIn('sended_cvs.id_number', $remitidos)
                    ->where('gender', $gender)
                    ->get();
                }

                $results[$legens[7] . ' ' . $gender . ' No data '] =  DB::table('sended_cvs')
                            ->whereNull('sended_cvs.segmento')
                            ->whereRaw("STR_TO_DATE(sended_cvs.date, '%d-%b-%y') >= '$this->date_init'")
                            ->whereRaw("STR_TO_DATE(sended_cvs.date, '%d-%b-%y') <= '$this->date_end' ")
                            ->where('gender', $gender)
                            ->get();
            }



            foreach ($sexos as $gender) {

                $cccv = DB::table('trainings')
                     ->where('trainings.id', 29)
                        ->join('participants', 'participants.trainings_id', 'trainings.id')
                        // ->where('participants.sexo', '<>', null)
                        ->where('participants.updated_at', '>=', $this->date_init)
                        ->where('participants.updated_at', '<=', $this->date_end)
                        ->select('participants.id')
                        ->pluck('id');


                $results[$legens[8] . ' ' . $gender ] = DB::table('participants')->where("participants.sexo", $gender)
                                                                                               ->whereNull('participants.segmento')
                                                                                               ->whereIn('participants.id', $cccv)
                                                                                               ->get();

                foreach ($poblacions as $poblacion) {
                    $results[$legens[8] . ' ' . $gender . ' ' . $poblacion->marital_status] = DB::table('trainings')
                                                                                                                     ->join('participants', 'participants.trainings_id', 'trainings.id')
                                                                                                                     ->where("participants.segmento", $poblacion->marital_status)
                                                                                                                     ->where("participants.sexo", $gender)
                                                                                                                     ->whereIn('participants.id', $cccv)
                                                                                                                     ->get();
                }


            }


            foreach ($sexos as $gender) {

                $participants = DB::table('trainings')
                     ->whereIn('trainings.id', [34, 39])
                        ->join('participants', 'participants.trainings_id', 'trainings.id')
                        // ->where('participants.sexo', '<>', null)
                        ->where('participants.updated_at', '>=', $this->date_init)
                        ->where('participants.updated_at', '<=', $this->date_end)
                        ->select('participants.id')
                        ->pluck('id');


                $results[$legens[9] . ' ' . $gender ] = DB::table('participants')->where("participants.sexo", $gender)
                                                                                               ->whereNull('participants.segmento')
                                                                                               ->whereIn('participants.id', $participants)
                                                                                               ->get();

                foreach ($poblacions as $poblacion) {
                    $results[$legens[9] . ' ' . $gender . ' ' . $poblacion->marital_status] = DB::table('trainings')
                                                                                                                     ->join('participants', 'participants.trainings_id', 'trainings.id')
                                                                                                                     ->where("participants.segmento", $poblacion->marital_status)
                                                                                                                     ->where("participants.sexo", $gender)
                                                                                                                     ->whereIn('participants.id', $participants)
                                                                                                                     ->get();
                }


            }

            foreach ($sexos as $gender) {

                $participants = DB::table('trainings')
                     ->where('trainings.id', 27)
                        ->join('participants', 'participants.trainings_id', 'trainings.id')
                        // ->where('participants.sexo', '<>', null)
                        ->where('participants.updated_at', '>=', $this->date_init)
                        ->where('participants.updated_at', '<=', $this->date_end)
                        ->select('participants.id')
                        ->pluck('id');


                $results[$legens[9] . ' ' . $gender ] = DB::table('participants')->where("participants.sexo", $gender)
                                                                                               ->whereNull('participants.segmento')
                                                                                               ->whereIn('participants.id', $participants)
                                                                                               ->get();

                foreach ($poblacions as $poblacion) {
                    $results[$legens[9] . ' ' . $gender . ' ' . $poblacion->marital_status] = DB::table('trainings')
                                                                                                                     ->join('participants', 'participants.trainings_id', 'trainings.id')
                                                                                                                     ->where("participants.segmento", $poblacion->marital_status)
                                                                                                                     ->where("participants.sexo", $gender)
                                                                                                                     ->whereIn('participants.id', $participants)
                                                                                                                     ->get();
                }


            }

            return view('export.datos', compact('results', 'company_registered'));
        } catch (\Throwable $th) {

            dd([$th->getMessage(), $th->getLine(), $th->getFile()]);

            return view('admin.home');
        }
    }
}
