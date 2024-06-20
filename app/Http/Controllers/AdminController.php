<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('component.dashboard');
    }
    public function setup(){
        return view('component.setup');
    }
}
