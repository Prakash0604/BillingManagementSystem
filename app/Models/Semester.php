<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;
    public function program(){
        $this->hasMany(Program::class);
    }

    public function batch_type(){
       return  $this->hasMany(type_semester_year::class);
    }
}
