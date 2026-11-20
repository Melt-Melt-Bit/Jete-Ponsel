<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'sku' => ['required', 'string', 'max:80', 'unique:products,sku'],
            'brand' => ['required', 'string', 'max:80'],
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'in:phone,earphone,accessory'],
            'description' => ['nullable', 'string', 'max:5000'],
            'price' => ['required', 'integer', 'min:1', 'max:999999999'],
            'stock' => ['required', 'integer', 'min:0', 'max:999999'],
            'badge' => ['nullable', 'string', 'max:40'],
            'image_path' => ['required', 'string', 'max:500', 'regex:/\Aresources\/images\/(?:phones|headphones)\/[\w .()\-]+\.png\z/i'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $imagePath = $this->input('image_path');

                if (is_string($imagePath) && preg_match('/\Aresources\/images\/(?:phones|headphones)\/[\w .()\-]+\.png\z/i', $imagePath) && ! is_file(base_path($imagePath))) {
                    $validator->errors()->add('image_path', 'Choose an existing PNG image from the product image folders.');
                }
            },
        ];
    }
}
