<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Program;
use App\Models\Student;
use App\Models\currentbatch;
use Illuminate\Http\Request;
use App\DataTables\StudentsDataTable;

class ReportController extends Controller
{
    public function show(Request $request){

            $batch=$request->input('batch_name');
            $program=$request->input('program_name');
            $semester=$request->input('semester');
        // if($request!=null){
        //     $students=Student::where('batchname_id','likes','%'.$batch.'%')->orwhere('programname_id','likes','%'.$program.'%')->orwhere('year_semester','likes','%'.$semester.'%')->get();
        // }else{
        //     $students=Student::where('status',1)->get();
        // }
        $query = Student::with('currentbatch','batch','program');

        if (!is_null($batch)) {
            $query->where('batchname_id', 'like', '%'.$batch.'%');
        }

        if (!is_null($program)) {
            $query->orWhere('programname_id', 'like', '%'.$program.'%');
        }

        if (!is_null($semester)) {
            $query->orWhere('year_semester', 'like', '%'.$semester.'%');
        }

        $students = $query->get();

        if ($students->isEmpty()) {
            // Fetch all students if the query returns empty
            $students = Student::where('status', 1)->get();
        }
        $academicyear=Batch::where('status',1)->get();
        $programs=Program::where('status',1)->get();
        return view('Report.BatchWiseReport',compact('academicyear','programs','students'));
    }

    public function dataBatchwise($id){
        try{
            $data=currentbatch::with('program')->where('batch_id',$id)->get();
            return response()->json(['success'=>true,'message'=>$data]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function dataSemesterwise($id){
        try{
            $data=currentbatch::with('program')->where('program_id',$id)->get();
            return response()->json(['success'=>true,'data'=>$data]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function reportBatchwise(){
        try{
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    // public function show(StudentsDataTable $dataTable){
    //     return $dataTable->render('Report.BatchWiseReport');
    // }
    // public function test(){

    //     $data=DB::table('feeparticualrs')->select('particular_name',DB::raw("YEAR(created_at) as year" ))->get();
    //     $createddate=$data->pluck('year');
    //     $now=Carbon::now()->year;
    //     $show=[];
    //     foreach($createddate as $year){
    //         $dateofbirth=$now-$year;
    //         $show=$dateofbirth;
    //     }
    //     return ["All data"=>$data,"created_year"=>$createddate,"current_year"=>$now,'date_of_birth'=>$dateofbirth,'date of birth'=>$show];
    // }


}

