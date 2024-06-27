<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\currentbatch;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students=Student::orderBy('id','DESC')->get();
        return view('component.StudentList',['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters=currentbatch::with('batch','program')->get();
        return view('component.StudentsAdd',['semesters'=>$semesters]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name'=>'required|string|min:3',
            'address'=>'required|string',
            'date_of_birth'=>'required|date',
            'contact'=>'required|integer|min:8',
            'gender'=>'required',
            'image'=>'mimes:jpg,png,jpeg',
            'email'=>'email|unique:students',
        ]);
        $imagepath=$request->image;
        if($request->has('image')){
            $image=$request->file('image');
            $imagepath=time().'.'.$image->getClientOriginalName();
            $image->storeAs('public/images/'.$imagepath);
        }
        $username='STU'.Str::random(5).'2081';
        Student::create([
            'username'=>$username,
            'password'=>$username,
            'student_name'=>$request->student_name,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'address'=>$request->address,
            'contact'=>$request->contact,
            'gender'=>$request->gender,
            'batch_name'=>$request->batch_name,
            'program'=>$request->program,
            'type'=>$request->current_type,
            'father_name'=>$request->father_name,
            'father_contact'=>$request->father_contact,
            'mother_name'=>$request->mother_name,
            'mother_contact'=>$request->mother_contact,
            'previous_college'=>$request->previous_college,
            'image'=>$imagepath,
        ]);

        return redirect()->route('students.index')->with(['message'=>'Student has been created']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $student= Student::find($id);
        return view('component.StudentProfile',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studentedit=Student::find($id);
        $semesters=currentbatch::with('batch','program')->get();
        return view('component.StudentsEdit',['semesters'=>$semesters,'studentedit'=>$studentedit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
