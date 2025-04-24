<?php

namespace App\Modules\Exchange\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ExchangeLatestRequest",
 *     type="object",
 *     @OA\Property(
 *         property="base",
 *         type="string",
 *         example="USD",
 *         description="Базовая валюта для конвертации"
 *     ),
 *     @OA\Property(
 *         property="symbols",
 *         type="string",
 *         example="USD,RUB",
 *         description="Список символов для фильтрации, разделенный запятыми"
 *     ),
 *     @OA\Property(
 *         property="prettyprint",
 *         type="string",
 *         example="true",
 *         description="Флаг для форматирования ответа (допустимые значения: 'true' или 'false')"
 *     ),
 *     @OA\Property(
 *         property="show_alternative",
 *         type="string",
 *         example="false",
 *         description="Флаг для отображения альтернативных курсов (допустимые значения: 'true' или 'false')"
 *     )
 * )
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
