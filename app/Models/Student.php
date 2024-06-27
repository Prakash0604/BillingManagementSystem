<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    public $fillable=['username','password','student_name','image','email','date_of_birth','address','contact','gender','type','batch_name','program','father_name','father_contact','mother_name','mother_contact','previous_college'];
    public function semesters(){
       return $this->belongsTo(currentbatch::class);
    }
}
