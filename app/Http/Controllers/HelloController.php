<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function show(){
        return redirect(route('login'));
    }
}
