<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentWebhookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_id' => "required|integer",
            'status' => ['required', function (string $attribute, mixed $value, \Closure $fail) {
                $allowed_status = ['success', 'failed'];
                if (in_array($value, $allowed_status)) {
                    return;
                }
                $fail("Status '$value' is not be allowed");
            }]
        ];
    }
}
