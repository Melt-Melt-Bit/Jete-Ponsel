<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:ready_for_pickup,completed,cancelled'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $order = $this->route('order');

                if (! $order instanceof Order) {
                    return;
                }

                $allowedTransitions = [
                    'pending' => ['ready_for_pickup', 'completed', 'cancelled'],
                    'ready_for_pickup' => ['completed', 'cancelled'],
                    'completed' => [],
                    'cancelled' => [],
                ];

                if (! in_array($this->string('status')->toString(), $allowedTransitions[$order->status] ?? [], true)) {
                    $validator->errors()->add('status', 'That order status transition is not allowed.');
                }
            },
        ];
    }
}
