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
        // Define the validation rules
        $rules = [
            // Each element in the array must be a string
            'selectedSolutions.*.number' => 'required|integer',
            'selectedSolutions.*.solution' => 'required|string',
            'selectedSolutions.*.solutionType' => 'required|string',
            'selectedSolutions.*.type' => 'required|string',
            'selectedSolutions.*.status' => 'boolean',
            'selectedSolutions.*.additionalOption' => 'nullable|array', // Can be nullable
            'selectedSolutions.*.additionalOption.*' => 'string', // Each element in the array must be a string
            'solutionType' => 'required|array',
            'solutionType.*' => 'string', // Each element in the array must be a string
            'client_id' => 'required|string',
            'status' => 'boolean',
        ];

        // Add custom logic to modify the solutionType if it's different from "sage"
        $solutionType = $this->input('solutionType');
        if (!empty($solutionType) && is_array($solutionType) && count($solutionType) > 0) {
            foreach ($solutionType as $key => $value) {
                // Check if the solutionType is different from "sage"
                if ($value !== 'sage') {
                    // Modify the solutionType to "infrastructure"
                    $this->merge([
                        "solutionType.$key" => "infrastructure"
                    ]);
                }
            }
        }

        return $rules;
    }
}
