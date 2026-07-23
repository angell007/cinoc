<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobRejectedMailable extends Mailable
{
    use SerializesModels;

    public $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function build()
    {
        $company = $this->job->getCompany();

        return $this->to($company->email, $company->name)
            ->subject('Resultado de la revisión de su vacante- Bolsa de Empleo UNIOC')
            ->view('emails.job_rejected');
    }
}
