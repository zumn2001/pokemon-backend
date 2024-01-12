<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'image_id' => 'required',
            'price' => 'required',
            'rarity_id' => 'required',
            'type_id' => 'required',
            'set_id' => 'required',
            'quantity' => 'required',
            'status' => 'required'
        ];
    }
}
