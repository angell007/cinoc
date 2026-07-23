<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyRegistrationReceivedMailable extends Mailable
{
    use SerializesModels;

    public $company;

    public function __construct($company)
    {
        $this->company = $company;
    }

    public function build()
    {
        return $this->to($this->company->email, $this->company->name)
            ->subject('Solicitud de registro recibida - Bolsa de Empleo UNIOC')
            ->view('emails.company_registration_received');
    }
}
