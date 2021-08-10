<?php

namespace App\Http\Requests;

use App\Rules\IsEmployeeOnAnotherDelegationRule;

class CreateDelegationRequest extends BaseRequest
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
        return [
            'country' => ['required', 'exists:countries,code'],
            'date_start' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'date_end' => ['required', 'date', 'after:date_start', 'date_format:Y-m-d H:i:s'],
            'employee_identifier' => ['required', 'exists:employees,identifier', new IsEmployeeOnAnotherDelegationRule([
                'date_start' => $this->get('date_start'),
                'date_end' => $this->get('date_end')
            ])],
        ];
    }
}
