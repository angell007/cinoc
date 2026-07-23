<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyResetPassword extends Notification
{
    /**

     * The password reset token.

     *

     * @var string

     */

    public $token;



    /**

     * Create a new notification instance.

     *

     * @param $token

     */

    public function __construct($token)
    {

        $this->token = $token;

    }



    /**

     * Get the notification's delivery channels.

     *

     * @param  mixed  $notifiable

     * @return array

     */

    public function via($notifiable)
    {

        return ['mail'];

    }



    /**

     * Get the mail representation of the notification.

     *

     * @param  mixed  $notifiable

     * @return \Illuminate\Notifications\Messages\MailMessage

     */

    public function toMail($notifiable)
    {

        return (new MailMessage())

                        ->subject('Restablecimiento de contraseña')

                        ->from([config('mail.from.address') => config('mail.from.name')])

                        ->line('Has recibido este email por que has hecho la petición de restablecer tu contraseña')

                        ->action('Reset Password', url('company/password/reset', $this->token))

                        ->line('Si no has sido tu, no es requerida esta acción, por favor comunicate con nosotros.');

    }



}
