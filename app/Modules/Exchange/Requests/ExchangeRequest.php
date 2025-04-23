<?php

namespace App\Modules\Exchange\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Prepare incomming exchange request data
 */
class ExchangeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'base' => ['sometimes', 'string'],
            'symbols' => ['sometimes', 'string'],
            'prettyprint' => ['sometimes', 'string', 'in:true,false'],
            'show_alternative' => ['sometimes', 'string', 'in:true,false'],
        ];
    }
}
