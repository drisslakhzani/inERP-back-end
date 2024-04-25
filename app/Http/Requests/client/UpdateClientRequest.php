<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstName' => 'string|max:255',
            'companyName' => 'string|max:255',
            'phoneNumber' => 'string|max:255',
            'email' => 'email|max:255',
            // Add more rules for other fields if necessary
        ];
    }
}
