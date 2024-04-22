<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'clients';
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
