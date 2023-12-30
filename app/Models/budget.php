<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;



class budget extends Model
{

    public static function validate($data){
        $data->validate([
            "for_who"=>"require|unique:budgets",
            'total_outflow'=>"required|gt:0",
            'total_inflow'=>"required|gt:0",
        ]);
    }


}
