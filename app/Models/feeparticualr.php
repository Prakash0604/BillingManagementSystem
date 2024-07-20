<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class feeparticualr extends Model
{
    use HasFactory;
    public $fillable=['particular_name','description','status'];
}
