<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public static function sendEmail($to, $subject, $view, $data = [])
    {
        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject)->from(MAUZO_ADMIN, 'Lightline Research');
        });
    }
}
