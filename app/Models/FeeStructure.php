<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;
    protected $fillable=['current_batch_id','particular_id','times','amounts','total_amounts','net_amounts','gross_amounts','status'];
    public function batch(){
        return $this->hasOne(currentbatch::class,'current_batch_id','id');
    }

    public function particular(){
        return $this->hasMany(feeparticualr::class);
    }
}
