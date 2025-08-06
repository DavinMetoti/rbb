<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function locale()
    {
        return view('test.locale');
    }
}
