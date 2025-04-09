<?php

namespace App\Http\Controllers\Birja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BirjaController extends Controller
{
    public function birja(){
        return view('/birja/birja');
    }
}