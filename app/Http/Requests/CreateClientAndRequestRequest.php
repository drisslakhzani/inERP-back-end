<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientAndRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'clientData.firstName' => 'required|string',
            'clientData.companyName' => 'required|string',
            'clientData.phoneNumber' => 'required|string',
            'clientData.email' => 'required|email',
            'requestDetails.selectedSolutions' => 'required|array',
            'requestDetails.solutionType' => 'required|string',
        ];
    }
}
