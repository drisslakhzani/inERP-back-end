<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $fillable = [
        'adminName',
        'login',
        'password',
        'phoneNumber',
        'whatsappNumber',
        'email',
        'facebook',
        'instagram',
        'linkedIn',
        'twitter',
        'locationAddress',
    ];
}
