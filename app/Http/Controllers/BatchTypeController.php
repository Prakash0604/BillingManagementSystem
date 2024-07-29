<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\type_semester_year;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BatchTypeController extends Controller
{
    protected $title="Batch Type Semester/Year";
    public function getTitle(){
        return $this->title;
    }
    public function index(Request $request){
        $type=Semester::where('status',1)->get();
        $Semesters=type_semester_year::with('batch_type')->Where('data_id',1)->get();
        $Years=type_semester_year::with('batch_type')->Where('data_id',2)->get();
        return view("BatchType.index",compact('type','Semesters','Years'),['title'=>$this->title]);
    }



    public function create(){
        return view("BatchType.create",['title'=>$this->title]);
    }

    public function store(Request $request){
        try{
            $request->validate([
                'type_name'=>'required'
            ]);
            type_semester_year::create([
                'data_id'=>$request->type_id,
                'name'=>$request->type_name,
                'running'=>$request->running_status,
            ]);
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }
}
public function data($id){
    try{
       $batch_data= type_semester_year::with('batch_type')->find($id);
       return response()->json(['success'=>true,'batch_data'=>$batch_data]);

    }catch(\Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }
}

public function update(Request $request){
    try{

        $id=$request->edit_year_id;
        type_semester_year::where('id',$id)->update([
            'data_id'=>$request->editType_id,
            'name'=>$request->editType_name,
            'running'=>$request->editRunning_status,
            'status'=>$request->edit_status,
        ]);
        return response()->json(['success'=>true]);
    }catch(\Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }

}

public function delete($id){
    try{
        type_semester_year::where('id',$id)->delete();
        return response()->json(['success'=>true]);
    }catch(\Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }
}

}
