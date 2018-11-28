<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreListingFormRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'image', 'mime:jpeg,jpg,png'],
            'category' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('usable', true);
                }),
            ],
            'area' => [
                'required',
                Rule::exists('areas', 'id')->where(function ($query) {
                    $query->where('usable', true);
                }),
            ],
        ];
    }
}
