<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyRegistrationRejectedMailable extends Mailable
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
            ->subject('Resultado de su solicitud de registro en la Bolsa de Empleo UNIOC')
            ->view('emails.company_registration_rejected');
    }
}
