<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_semester_year extends Model
{
    use HasFactory;
    protected $table='type_semester_years';
    protected $fillable = ['data_id','name','running','status'];

    public function batch_type(){
        return $this->belongsTo(Semester::class,'data_id','id');
    }
}
