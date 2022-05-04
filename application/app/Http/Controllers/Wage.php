<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Wage extends Controller
{
    public function list(){
        $this->authorize('wage.index');
        return view('wage.index');
    }
}
