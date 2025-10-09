<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show(){
        $message = "Welcome to Laravel! Jelita";
        return view('mywelcome', ['message' => $message]);
    }
}
