<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Program;
use App\Models\Semester;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    // Add Batch Function Start
    public function setup()
    {
        $batches = Batch::orderBy('id', 'desc')->paginate(4);
        $types = Semester::all();
        $programs=Program::with('types')->orderBy('id','desc')->paginate(4);
        $data = compact('batches', 'types','programs');
        return view('component.setup', $data);
    }

    // Add Batch Function Start
    public function storeBatch(Request $request)
    {
        try {
            // $data=$request->all();
            $request->validate([
                'batch_name' => 'required|max:50|string|unique:batches',
                'starting_date' => 'required|date',
                'ending_date' => 'required|date',
            ]);
            $batch = Batch::create([
                'batch_name' => $request->batch_name,
                'starting_date' => $request->starting_date,
                'ending_date' => $request->ending_date,
            ]);
            return response()->json(['success' => true, 'message' => $batch, 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }
    // Add Batch Function End

    // Edit Batch Function Start
    public function edit_batch($id)
    {
        try {
            $batch = Batch::find($id);
            return response()->json(['success' => true, 'message' => $batch, 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }

    // Edit Batch Function End

    // Update Batch Function Start
    public function updateBatch(Request $request)
    {
        try {
            $request->validate([
                'edit_batch_name' => 'required|max:50|string',
                'edit_starting_date' => 'required|date',
                'edit_ending_date' => 'required|date',
            ]);
            $id = $request->id;
            $data = $request->all();
            Batch::find($id)->update([
                'batch_name' => $request->edit_batch_name,
                'starting_date' => $request->edit_starting_date,
                'ending_date' => $request->edit_ending_date,
                'status' => $request->edit_status,
            ]);
            return response()->json(['success' => true, 200, $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }
    // Update Batch Function End

    // Delete Batch Start
    public function deleteBatch($id)
    {
        try {
            Batch::find($id)->delete();
            return response()->json(['success' => true, 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }
    // Delete Batch End




    // Program Function Start

    // Add Batch Function Start
    public function storeProgram(Request $request)
    {
        try {
            // $data=$request->all();
            $request->validate([
                'program_name' => 'required|max:50|string|unique:programs',
                'faculty' => 'required',
                'univeristy' => 'required',
                'type' => 'required',
            ]);
            $program = Program::create([
                'program_name' => $request->program_name,
                'faculty' => $request->faculty,
                'univeristy' => $request->univeristy,
                'type_id' => $request->type,
            ]);
            return response()->json(['success' => true, 'message' => $program, 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }
    // Add Batch Function End

    // Edit Batch Function Start
    public function edit_program($id)
    {
        try {
            $program = Program::find($id);
            return response()->json(['success' => true, 'message' => $program, 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }

    // Edit Batch Function End

    // Update Batch Function Start
    public function updateProgram(Request $request)
    {
        try {
            $request->validate([
                'edit_program_name' => 'required|max:50|string',
                'edit_faculty' => 'required',
                'edit_univeristy' => 'required',
                'edit_type' => 'required',
            ]);
            $data = $request->all();
            $id = $request->id;
            Program::find($id)->update([
                'program_name' => $request->edit_program_name,
                'faculty' => $request->edit_faculty,
                'univeristy' => $request->edit_univeristy,
                'type_id' => $request->edit_type,
                'status' => $request->edit_status,
            ]);
            return response()->json(['success' => true, 200, $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }
    // Update Batch Function End

    // Delete Batch Start
    public function deleteProgram($id)
    {
        try {
            Program::find($id)->delete();
            return response()->json(['success' => true, 200]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 500]);
        }
    }
    // Delete Batch End

    // Program Function End
}