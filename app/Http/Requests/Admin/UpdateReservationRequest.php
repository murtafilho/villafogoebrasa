<?php

namespace App\Http\Requests\Admin;

use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservationRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'guests' => ['required', 'integer', 'min:1', 'max:50'],
            'occasion' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'string', Rule::in([
                Reservation::STATUS_PENDING,
                Reservation::STATUS_CONFIRMED,
                Reservation::STATUS_CANCELLED,
                Reservation::STATUS_COMPLETED,
            ])],
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
            'time.required' => 'O horário é obrigatório.',
            'guests.required' => 'O número de convidados é obrigatório.',
            'guests.min' => 'Deve haver pelo menos 1 convidado.',
            'guests.max' => 'O número máximo de convidados é 50.',
            'status.required' => 'O status é obrigatório.',
        ];
    }
}
