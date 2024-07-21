<?php

namespace App\Http\Requests;

use App\Models\BankInfo;
use Illuminate\Foundation\Http\FormRequest;

class CreateBankInfoRequest extends FormRequest
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
        return BankInfo::$rules;
    }
}
