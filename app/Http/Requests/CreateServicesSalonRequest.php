<?php

namespace App\Http\Requests;

use App\Models\ServicesSalon;
use Illuminate\Foundation\Http\FormRequest;

class CreateServicesSalonRequest extends FormRequest
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
        return ServicesSalon::$rules;
    }
}
