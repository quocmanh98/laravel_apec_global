<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Work extends Controller
{
    //
    public function list(){
        $this->authorize('work.index');
        return view('work.index');
    }
}
