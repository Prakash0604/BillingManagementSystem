<?php

use App\Models\currentbatch;
use App\Models\feeparticualr;

if(!function_exists('feeparticular')){
    function feeparticular(){
        return feeparticualr::where('status',1)->pluck('id','particular_name');
    }
}

if(!function_exists('academic_year')){
    function  academic_year(){
        return currentbatch::with('batch','program')->where('status',1)->pluck('id','batch_id');
    }
}

if(!function_exists('semester')){
    function  semester(){
        return currentbatch::where('status',1)->pluck('semester');
    }
}
