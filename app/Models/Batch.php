<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;
    protected $fillable=['batch_name','starting_date','ending_date','status'];
    public function semester(){
        return $this->hasMany(currentbatch::class);
    }

    public function program(){
        return $this->hasMany(program::class);
    }

    public function feestructure(){
        return $this->belongsTo(Feestructure::class);
    }

    public function student(){
        return $this->hasMany(Student::class);
    }
}
