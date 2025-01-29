<?php

namespace Ccns\CcnsEcommerceCart\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
            'id' => ['integer', 'exists:carts,id'],
            'quantity' => ['integer', 'required', 'min:1', 'max:99'],
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
