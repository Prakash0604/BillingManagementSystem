<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $totalstudent=Student::all()->count();
        $data=compact('totalstudent');
        return view('component.dashboard',$data);
    }
}
