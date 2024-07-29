<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\currentbatch;
use App\Models\Program;
use Illuminate\Http\Request;

class FeeStructure extends Controller
{
    protected $title="Fee Structure";

    public function getTitle(){
        return $this->title;
    }
    public function index(){
        return view("Billing.FeeStructure.index",['title'=>$this->title]);
    }

    public function create(){
        $batch=Batch::where('status',1)->get();
        $program=Program::where('status',1)->get();
        $semester=currentbatch::where('status',1)->pluck('semester');
        return view('Billing.FeeStructure.create',compact('batch','program','semester'),['title'=>$this->title]);
    }

    public function store(Request $request){

    }
}
