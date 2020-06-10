<?php

namespace Illuminate\Auth\Passwords;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

trait CanResetPassword
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $message = "
            <html>
            <head>
            <title>Password reset</title>
            </head>
            <body>
            <p>Hi!</p>
            <br>
            <p>We received a request to reset your " . env('APP_NAME') . " password.</p>
            <br>
            <p>If you’re having trouble clicking the <a href='" . env('APP_URL') . "password/reset/$token'>Password reset</a> link, copy and paste the URL below.<br></p>
            <p>" . env('APP_URL') . "password/reset/$token</p>
            </body>
            </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: ' . env('MAIL_FROM_NAME') . ' <' . env('MAIL_FROM_ADDRESS') . '>' . "\r\n";

        mail($this->email, "Password reset", $message, $headers);

        // Ovde bi u stvari trebalo posalti email sa linkom za reset
        // $this->notify(new ResetPasswordNotification($token));
    }
}
