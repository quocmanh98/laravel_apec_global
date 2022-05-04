<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function sendmail(){
        $data = [
            'k' => request()->email
        ];
        Mail::to(request()->email)->send(new DemoMail($data));
    }
}
