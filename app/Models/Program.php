<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    protected $fillable=['program_name','faculty','univeristy','status','type_id'];
    use HasFactory;
    public function types(){
       return  $this->belongsTo(Semester::class,'type_id','id');
    }
}
