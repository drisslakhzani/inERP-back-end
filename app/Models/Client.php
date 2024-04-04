<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Client extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'generated_code','company_name'];

    public function clientRequests()
    {
        return $this->hasMany(ClientRequest::class,'clients_id');
    }

    public static function RandomizeCode(){
        $generated_code=Str::random(30);
        return $generated_code;
    }
}
