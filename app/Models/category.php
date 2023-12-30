<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    public static function validate($data){
        $data->validate([
            'name'=>'require|unique:categories',
            'theme'=>'require',
        ]);

    }

}
