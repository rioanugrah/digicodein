<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryStoreRequest extends FormRequest
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
            'category' => 'required|unique:product_category.category',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Kategori Wajib Diisi',
            'category.unique' => 'Kategori Sudah Ada',
            'Status.required' => 'Status Wajib Diisi',
        ];
    }
}
