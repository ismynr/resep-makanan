<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResepRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kategori_id' => 'required|numeric|digits_between:1,3',
            'nama' => 'required|max:100|string|min:5',
            'deskripsi' => 'nullable|min:5',
            'bahan' => 'required|array|min:2'
        ];
    }
}
