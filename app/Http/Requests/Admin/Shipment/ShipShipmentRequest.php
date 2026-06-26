<?php

namespace App\Http\Requests\Admin\Shipment;

use Illuminate\Foundation\Http\FormRequest;

class ShipShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'carrier' => [
                'required',
                'string',
                'max:255',
            ],

            'tracking_code' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
