<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    // Add Batch Function Start
    public function setup(){
        $batches=Batch::orderBy('id','desc')->paginate(4);
        $data=compact('batches');
        return view('component.setup',$data);
    }


    public function storeBatch(Request $request){
        try{
            // $data=$request->all();
            $request->validate([
                'batch_name'=>'required|max:50|string|unique:batches',
                'starting_date'=>'required|date',
                'ending_date'=>'required|date',
            ]);
           $batch= Batch::create([
                'batch_name'=>$request->batch_name,
                'starting_date'=>$request->starting_date,
                'ending_date'=>$request->ending_date,
            ]);
            return response()->json(['success'=>true,'message'=>$batch,200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage(),500]);
        }
    }
    // Add Batch Function End

    // Edit Batch Function Start
    public function edit_batch($id){
        try{
            $batch= Batch::find($id);
            return response()->json(['success'=>true,'message'=>$batch,200]);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage(),500]);
        }
    }

    // Edit Batch Function End

    // Update Batch Function Start
    public function updateBatch(Request $request){
        try{

            $id=$request->id;
            $data=$request->all();
            Batch::find($id)->update([
                'batch_name'=>$request->edit_batch_name,
                'starting_date'=>$request->edit_starting_date,
                'ending_date'=>$request->edit_ending_date,
                'status'=>$request->edit_status,
            ]);
            return response()->json(['success'=>true,200,$data]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage(),500]);
        }
    }
    // Update Batch Function End
}
