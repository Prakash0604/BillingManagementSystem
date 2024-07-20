<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    public $fillable=['username','password','student_name','image','email','date_of_birth','address','contact','gender','father_name','father_contact','mother_name','mother_contact','previous_college','batchname_id','programname_id','year_semester'];

    public function setUsernameAttribute($string){
        $this->attributes['username']=strtolower($string);
    }

    public function getUsernameAttribute($string){
        return ucwords($string);
    }

    public function semesters(){
       return $this->belongsTo(currentbatch::class);
    }
    public function batch(){
        return $this->belongsTo(Batch::class,'batchname_id','id');
    }

    public function program(){
        return $this->belongsTo(Program::class,'programname_id','id');
    }

    public function currentbatch(){
        return $this->belongsTo(currentbatch::class);
    }
}
