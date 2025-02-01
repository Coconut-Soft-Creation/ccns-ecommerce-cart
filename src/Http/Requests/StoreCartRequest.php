<?php

namespace Ccns\CcnsEcommerceCart\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product' => ['array', 'required'],
            'price' => ['integer', 'required'],
            'quantity' => ['integer', 'min:1', 'max:99', 'required'],
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
