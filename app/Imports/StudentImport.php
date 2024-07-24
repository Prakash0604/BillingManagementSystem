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
        ]);
    }
}
