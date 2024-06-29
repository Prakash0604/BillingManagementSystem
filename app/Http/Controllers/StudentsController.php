<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\currentbatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{

    public function index()

    {

        $students=Student::orderBy('id','DESC')->get();

        return view('component.StudentList',['students'=>$students]);

    }



    /**

     * Show the form for creating a new resource.

     */

    public function createStudent()

    {

        $batchdata=Batch::with('semester')->get();


        return view('component.StudentsAdd',['batchdata'=>$batchdata]);

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
            'password'=>Hash::make($username),
            'student_name'=>$request->student_name,
            'email'=>$request->email,
            'date_of_birth'=>$request->date_of_birth,
            'address'=>$request->address,
            'contact'=>$request->contact,
            'gender'=>$request->gender,
            'batchname_id'=>$request->batch_name,
            'programname_id'=>$request->program,
            'year_semester'=>$request->current_type,
            'father_name'=>$request->father_name,
            'father_contact'=>$request->father_contact,
            'mother_name'=>$request->mother_name,
            'mother_contact'=>$request->mother_contact,
            'previous_college'=>$request->previous_college,
            'image'=>$imagepath,
        ]);
        return redirect()->route('students.index')->with(['message'=>'Student has been created']);

    }

    public function show($id){
        $student=Student::find($id)->with('semesters','program','batch')->get();
        // return view('component.StudentProfile',['student'=>$student]);
        return response()->json(['student'=>$student]);
        // $student->toArrary();
    }

    public function destroy($id){
        $student=Student::find($id);
        if($student!=""){
            $student->delete();
            return redirect()->route('students.index')->with(['message'=>'Student has been deleted']);
        }else{
            return view('ErrorPage.404');
        }
    }

        // Unique Program selection in student Start
        public function getprogram($id){
            $batchdata=currentbatch::where('batch_id',$id)->with('batch','program')->get();
            return response()->json(['success'=>true,'programdata'=>$batchdata]);
        }
        // Unique Program selection in student End

        // Unique Semester Selection in Student Start
        public function getsemester($id){
            $semesterdata=currentbatch::where('program_id',$id)->with('batch','program')->get();
            return response()->json(['success'=>true,'semesterdata'=>$semesterdata]);
        }
        // Unique Semester Selection in Student End
}
