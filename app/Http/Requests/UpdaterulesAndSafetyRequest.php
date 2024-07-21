<?php

namespace App\Http\Requests;

use App\Models\rulesAndSafety;
use Illuminate\Foundation\Http\FormRequest;

class UpdaterulesAndSafetyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = rulesAndSafety::$rules;
        
        return $rules;
    }
}
