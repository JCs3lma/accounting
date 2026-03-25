<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo_path' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'brand_id' => 'nullable|numeric|exists:brands,id',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'unit_id' => 'nullable|numeric|exists:units,id',
            'barcode' => 'nullable|string|max:50|unique:products,barcode,'.$this->route('product'),
            'serial_number' => 'nullable|string|max:100|unique:products,serial_number,' . $this->route('product'),
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $this->route('product'),
            'is_active' => 'boolean',
        ];
    }
}
