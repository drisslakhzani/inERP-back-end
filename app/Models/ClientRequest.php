<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    use HasFactory;

    protected $fillable = ['service_needed','status'];
    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }
}
