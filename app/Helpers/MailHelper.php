<?php

namespace App\Helpers;
use App\Http\Responses\Api;
use App\Mail\GeneralMail;
use App\Jobs\SendMailJob;
use Auth,DB;
use Illuminate\Support\Facades\Request;


class MailHelper
{
    /**
     * Send mail sign up
     * 
     * @param Transaction $transaction
     */
    public static function sendMail($data)
    {
        $dataMail['token'] = $data->token;
        $dataMail['email'] = $data->email;
        $dataMail['subject'] = 'Reset Password';
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
            ->setView('emails.forgot_password', $dataMail)
            ->setSubject($dataMail['subject'])
            ->setTo($dataMail['email']);
        dispatch(new SendMailJob($mailJob));
    }
}
