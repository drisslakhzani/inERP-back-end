<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'selectedSolutions',
        'solutionType',
        'clients_id',
        'status'
    ];
    protected $casts=[
        'selectedSolutions'=>'array',
        'solutionType'=>'string',
        'status'=>'boolean',
    ];



    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }
}

