<?php

namespace App\Http\Controllers;

use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail($mail, $otp, $title )
    {
        $mailData = [
            'title' => $title,
            'otp' => $otp
        ];
         
        Mail::to($mail)->send(new Mailer($mailData));
    }
}
