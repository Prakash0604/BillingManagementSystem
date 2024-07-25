<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    protected $batch_name;
    protected $program_name;
    protected $year_semester;
    protected $username;
    protected $password;

    public function __construct($batch_name,$program_name,$year_semester,$username,$password){
        $this->batch_name=$batch_name;
        $this->program_name=$program_name;
        $this->year_semester=$year_semester;
        $this->username=$username;
        $this->password=$password;
    }
    public function model(array $row)
    {
        return new Student([
            'student_name'=>$row['student_name'],
            'email'=>$row['email'],
            'date_of_birth'=>$row['date_of_birth'],
            'address'=>$row['address'],
            'contact'=>$row['contact'],
            'gender'=>$row['gender'],
            'father_name'=>$row['father_name'],
            'father_contact'=>$row['father_contact'],
            'mother_name'=>$row['mother_name'],
            'mother_contact'=>$row['mother_contact'],
            'previous_college'=>$row['previous_college'],
            'batchname_id'=>$this->batch_name,
            'programname_id'=>$this->program_name,
            'year_semester'=>$this->year_semester,
            'username'=>$this->username,
            'password'=>$this->password
        ]);
    }
}
