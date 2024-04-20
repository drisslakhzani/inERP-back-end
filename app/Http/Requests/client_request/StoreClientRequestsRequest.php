<?php

namespace App\Http\Requests\client_request;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequestsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change to true to authorize all requests
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Each element in the array must be a string
            'selectedSolutions.*.number' => 'required|integer',
            'selectedSolutions.*.solution' => 'required|string',
            'selectedSolutions.*.solutionType' => 'required|string',
            'selectedSolutions.*.type' => 'required|string',
            'selectedSolutions.*.additionalOption' => 'nullable|array', // Can be nullable
            'selectedSolutions.*.additionalOption.*' => 'string', // Each element in the array must be a string
            'solutionType' => 'required|string',
            'solutionType.*' => 'string', // Each element in the array must be a string
            'client_id' => 'required|string',
            'status' => 'boolean',
        ];
    }
}

