<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    //Simple data passing
    public function hello(){
        $name = 'Laravel Learner';
        return view('hello', ['name' => $name]);
    }

    // Parameter Route
    public function greet($name) {
        return view('greet', ['name' => ucfirst($name)]);
    }

    // Query String 
    public function search(Request $request) {
        $keyword = $request->query('q', 'none');
        return view('search', ['keyword' => $keyword]);
    }
}
