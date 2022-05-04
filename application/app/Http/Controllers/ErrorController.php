<?php

namespace App\Http\Controllers;

use App\Mail\Error;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ErrorController extends Controller
{
    public function error(){
        return view('error.acc');
    }
}
