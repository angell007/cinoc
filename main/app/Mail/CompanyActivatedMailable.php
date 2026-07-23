<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyActivatedMailable extends Mailable
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
            ->subject('Activación de su empresa- Bolsa de empleo UNIOC')
            ->view('emails.company_activated');
    }
}
