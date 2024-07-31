<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\currentbatch;
use App\Models\Program;
use App\Models\feeparticualr;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index_courseFee(){
        return view("Billing.FeeStructure.index");
    }
    public function create_courseFee(){
        $particular=feeparticualr::where('status',1)->get();
        $batches=Batch::where('status',1)->get();
        return view("Billing.FeeStructure.create",compact("batches","particular"));
    }
    public function fetchProgramData($id){
        try{
            $data=currentbatch::with('program')->where('batch_id',$id)->get();
            return response()->json(['success'=>true,'batch_data'=>$data]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function fetchSemesterData($id){
        try{
            $semester=currentbatch::where('program_id',$id)->get();
            return response()->json(['success'=>true,'semester'=>$semester]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
}
