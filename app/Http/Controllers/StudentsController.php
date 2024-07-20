<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\currentbatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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


    public function update(Request $request,$id){
        $request->validate([

            'student_name_edit'=>'required|string|min:3',
            'address_edit'=>'required|string',
            'date_of_birth_edit'=>'required|date',
            'contact_edit'=>'required|integer|min:8',
            'gender_edit'=>'required',
            'image_edit'=>'mimes:jpg,png,jpeg',
            'email_edit'=>'email',

        ]);

        $studentdata= Student::with('batch','program')->find($id);
        $currentimage=$studentdata->image;
        if($request->hasFile('image_edit')){

            $image=$request->file('image_edit');
            $currentimage=time().'.'.$image->getClientOriginalName();
            $image->storeAs('public/images/'.$currentimage);

            if($currentimage && Storage::exists("public/images/".$currentimage)){
                Storage::delete('public/images/'.$currentimage);
            }

        }
        $studentdata->update([

            'student_name'=>$request->student_name_edit,
            'email'=>$request->email_edit,
            'date_of_birth'=>$request->date_of_birth_edit,
            'address'=>$request->address_edit,
            'contact'=>$request->contact_edit,
            'gender'=>$request->gender_edit,
            'father_name'=>$request->father_name_edit,
            'father_contact'=>$request->father_contact_edit,
            'mother_name'=>$request->mother_name_edit,
            'mother_contact'=>$request->mother_contact_edit,
            'previous_college'=>$request->previous_college_edit,
            'image'=>$currentimage,
        ]);
        return redirect()->route('students.index')->with(['message'=>'Student has been Updated successfully']);

    }

    public function show($id){

            $student=Student::with('batch','program')->find($id);
            if($student!=null){
                return view('component.StudentProfile')->with('student',$student);
                // return response()->json(['student'=>$student]);
            }else{
                return view('ErrorPage.404');
            }
        // $student->toArrary();
    }

    public function edit($id){
        $student=Student::with('batch','program')->find($id);
        $batches=Batch::all();
        $programs=Program::all();
        return view('component.StudentsEdit',['studentedit'=>$student,'batches'=>$batches,'programs'=>$programs]);
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
