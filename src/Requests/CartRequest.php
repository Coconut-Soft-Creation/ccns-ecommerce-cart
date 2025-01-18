<?php

namespace Ccns\CcnsEcommerceCart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users'],
            'items' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
