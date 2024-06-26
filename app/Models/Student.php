<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    public $fillable=['student_name','image','email','date_of_birth','address','contact','gender','semester_id','father_name','father_contact','mother_name','mother_contact','previous_college'];
}
