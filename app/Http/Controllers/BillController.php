<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Models\currentbatch;
use Illuminate\Http\Request;
use App\Models\feeparticualr;

class BillController extends Controller
{
    public function index(){
        $batches=Batch::where('status',1)->get();
        $particular=feeparticualr::where('status',1)->get();
        return view('Billing.Bill.Receipt',compact('batches','particular'));
    }
    public function fetchProgramData($id){
        try{
            $data=currentbatch::with('program')->where('batch_id',$id)->get();
            return response()->json(['success'=>true,'message'=>$data]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function fetchSemesterData($id){
        try{
            $semester=currentbatch::where('program_id',$id)->get();
            return response()->json(['success'=>true,'message'=>$semester]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }



    public function fetchStudentData($id){
        try{

            $batches=currentbatch::where('id',$id)->get();
            // if($batches)
                // $students=Student::where('year_semester',$batches)->get();
                // dd($students);
            return response()->json(['success'=>true,'message'=>$batches]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function fetchStudenttypedata($type){
        try{
            $students=Student::where('year_semester',$type)->get();
            return response()->json(['success'=>true,'message'=>$students]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);

        }
    }
}
