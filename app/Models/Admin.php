<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; // Import the correct interface

class Admin extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable; // Use the correct trait

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
