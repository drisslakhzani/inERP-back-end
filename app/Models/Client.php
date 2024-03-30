<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Client extends Model
{
    use HasFactory;
    public static function RandomizeCode(){
        $generated_code=Str::random(30);
        return $generated_code;
    }
}
