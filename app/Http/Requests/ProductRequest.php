<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required|unique:products|max:100',
            'code' => 'required|max:10',
            'quantity' => 'required',
            'price' => 'required',
            'cpu' => 'required|max:100',
            'ram' => 'required',
            'description' => 'required|max:1000',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
