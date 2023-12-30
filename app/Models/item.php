<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class item extends Model
{
    use HasFactory;

    public static function validate($data){
        $data->validate([
            'name'=>"required|unique:items",            
            'cost'=>"required|gt:0",                        
            'income'=>"required"
        ]);
    }

    public static function updateValidate($data){
        $data->validate([
            'name'=>"required",            
            'cost'=>"required|gt:0",                        
            'income'=>"required"
        ]);
    }

}

