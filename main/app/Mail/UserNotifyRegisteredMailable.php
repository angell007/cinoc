<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotifyRegisteredMailable extends Mailable
{

    use SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, config('mail.recieve_to.name'))
                        ->subject('Registro en ' . config('app.name'))
                        ->view('emails.user_registered_message')
                        ->with(
                                [
                                    'name' => $this->user->name,
                                    'email' => $this->user->email,
                                    'link' => route('user.profile', $this->user->id),
                                    'link_admin' => route('edit.user', ['id' => $this->user->id])
                                ]
        );
    }

}
