<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['string', 'min:2', 'max:50'],
            'category' => ['string', 'min:2', 'max:50'],
            'provider' => ['string', 'min:2', 'max:50'],
            // 'date' => [],
        ];
    }
}
