<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['login', 'password', 'email', 'phone', 'address', 'file_name' , ];

    public function getFileUrlAttribute()
    {
        if ($this->file_name) {
            return Storage::url('path/to/files/' . $this->file_name);
        }
        return null;
    }
}

