<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\currentbatch;
use App\Models\Program;
use App\Models\feeparticualr;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class FeeStructureController extends Controller
{
    public function index_courseFee(){
        // $feestructures=FeeStructure::with(['batch'])->where('status',1)->get();
        $feestructures=DB::table('fee_structures')
        ->join('currentbatches','fee_structures.current_batch_id','currentbatches.id')
        ->join('feeparticualrs','fee_structures.particular_id','feeparticualrs.id')
        ->join('batches','currentbatches.batch_id','batches.id')
        ->join('programs','currentbatches.program_id','programs.id')
        ->where('fee_structures.status',1)
        ->select('fee_structures.id','times','amounts','total_amounts','net_amounts','gross_amounts','semester','year','particular_name','batch_name','starting_date','ending_date','program_name','faculty','univeristy','fee_structures.status')
        ->orderBy('fee_structures.id','asc')

        ->get();
        // dd($feestructures);

        return view("Billing.FeeStructure.index",compact('feestructures'));
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

    public function store_courseFee(Request $request){
        try{
            $validator =Validator::make($request->all(), [

            'batch_name' => 'required',
            'program_name' => 'required',
            'currentbatch_id' => 'required',
            'particulars' => 'required|array',
            'particulars.*' => 'required', // Assuming you have a particulars table
            'times' => 'required|array',
            'times.*' => 'required|numeric',
            'amounts' => 'required|array',
            'amounts.*' => 'required|numeric',
            'totalamounts' => 'required|array',
            'totalamounts.*' => 'required|numeric',
            'netAmounts' => 'required|numeric',
            'grossAmounts' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $currentBatch=$request->input('currentbatch_id');
            $particulars=$request->input('particulars');
            $times=$request->input('times');
            $amount=$request->input('amounts');
            $totalamounts=$request->input('totalamounts');
            $netamounts=$request->input('netAmounts');
            $grossamounts=$request->input('grossAmounts');
            // dd($request->all());
            foreach($particulars as $index=>$particular){
                if(isset($times[$index]) && isset($amount[$index]) && isset($totalamounts[$index])){
                    $data=[
                        'current_batch_id'=>$currentBatch,
                        'particular_id'=>$particular,
                        'times'=>$times[$index],
                        'amounts'=>$amount[$index],
                        'total_amounts'=>$totalamounts[$index],
                        'net_amounts'=>$netamounts,
                        'gross_amounts'=>$grossamounts,
                    ];
                    FeeStructure::create($data);
                    return response()->json(['success'=>true,'message'=>'saved']);
                }else{
                    return response()->json(['success'=>false,'message'=> 'Array Mismatches']);
                }
            }

        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function delete_coursefee($id){
        try{
           FeeStructure::where('id',$id)->delete();
               return response()->json(['success'=>true,'message'=>'Fee Structure has been deleted successfully','value'=>200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
}
