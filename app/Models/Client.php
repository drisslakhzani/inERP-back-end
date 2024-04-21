<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'companyName',
        'phoneNumber',
        'email',
        'generatedCode'
    ];

    public function clientRequests()
    {
        return $this->hasMany(ClientRequest::class,'clients_id');
    }
}
