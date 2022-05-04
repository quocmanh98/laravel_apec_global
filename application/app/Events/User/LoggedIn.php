<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Http\Request;

class LoggedIn {


    public function getUser(Request $request)
    {
        return User::where('email', request()->email)->first();
    }
}
