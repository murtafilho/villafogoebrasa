<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicReservationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'string'],
            'guests' => ['required'],
            'occasion' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'phone.required' => 'O telefone é obrigatório.',
            'date.required' => 'A data é obrigatória.',
            'date.after_or_equal' => 'A data deve ser hoje ou uma data futura.',
            'time.required' => 'O horário é obrigatório.',
            'guests.required' => 'O número de convidados é obrigatório.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Processar número de convidados se vier como "2 pessoas"
        if ($this->has('guests') && is_string($this->guests)) {
            $guestsStr = trim($this->guests);
            // Extrair número do texto "2 pessoas" ou "7+ pessoas"
            if (preg_match('/(\d+)/', $guestsStr, $matches)) {
                $this->merge([
                    'guests' => (int) $matches[1],
                ]);
            }
        }
    }
}
