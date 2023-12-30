<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    public static function validate($data){
        $data->validate([
            'name'=>'required|unique:locations',
            'latitude'=>'required|gt:-90|lt:90',
            'longitude'=>'required|gt:-180|lt:180',
        ]);
    }
}
