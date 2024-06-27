<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class currentbatch extends Model
{
    use HasFactory;
    protected $fillable=['batch_id','program_id','year','semester','status','type_id'];
    public function batch(){
        return $this->belongsTo(Batch::class);
    }
    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }
}
