<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApprovedMailable extends Mailable
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
            ->subject('Vacante publicada exitosamente- Bolsa de empleo UNIOC')
            ->view('emails.job_approved');
    }
}
