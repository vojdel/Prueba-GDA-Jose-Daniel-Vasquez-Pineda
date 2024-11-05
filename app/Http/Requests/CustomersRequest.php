<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use app\Enums\TrashEnum;

class CustomersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dni' => ['required', 'integer'],
            'id_reg' => ['required', 'integer'],
            'id_com' => ['required', 'integer'],
            'email' => ['required', 'string', 'max:120'],
            'name' => ['required', 'string', 'max:45'],
            'last_name' => ['required', 'string', 'max:45'],
            'address' => ['required', 'string', 'max:255'],
            'date_reg' => ['required', 'date'],
            'trash' => ['required', Rule::in(['A', 'I'])]
        ];
    }
}
