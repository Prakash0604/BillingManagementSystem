<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\feeparticualr;
use App\Services\particularService;

class particularcontroller extends Controller
{
    protected $particularService;
    public function particular(){
        $particular=feeparticualr::all();
        return view('Billing.particular',['particulars'=>$particular]);
    }

    public function storeparticular(Request $request){
        // dd($request->all());

        try{

            $request->validate([
                'particular_name'=>'required|string|min:3|unique:feeparticualrs',
            ]);
            feeparticualr::create([
                'particular_name'=>$request->particular_name,
                'description'=>$request->description,
            ]);
            return response()->json(['success'=>true,200]);
            }catch(\Exception $e){
                return response()->json(['success'=>false,'message'=>$e->getMessage()]);
            }

    }

  public function particulardata($id){
    try{
        $data=feeparticualr::find($id);
        return response()->json(['success'=>true,'message'=>$data]);

    }catch(\Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }
  }

  public function updateParticular(Request $request){
      try{
        $id=$request->id;
        $data=feeparticualr::find($id);
        $data->update([
            'particular_name'=>$request->particular_name,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        return response()->json(['success'=>true]);
    }catch(\Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }
  }

  public function deleteParticular($id){
    try{
        feeparticualr::find($id)->delete();
        return response()->json(['success'=>true]);
    }catch(\Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }
  }


}
