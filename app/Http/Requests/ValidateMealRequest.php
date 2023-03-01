<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;



class ValidateMealRequest extends FormRequest
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
            'per_page'     => 'sometimes|integer|between:1,100',
            'page'         => 'sometimes|integer|min:1',
            'category'     => 'regex:/^[!null1-5]+$/|string',
            'tags.*'       => 'integer|between:1,10',
            'with.*'       => 'string|in:ingredients,category,tags',
            'lang'         => 'required|string|min:2|max:5|exists:languages,locale',
            'diff_time'    => 'sometimes|integer|min:1'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    // public function messages()
    // {
    //     return [];
    // }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'with' => !empty($this->with) ? array_filter(explode(',', $this->with)) : [],
            'tags' => !empty($this->tags) ? array_filter(explode(',', $this->tags)) : []
        ]);
    }

    /**
     * Validation failure.
     *
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors()
            ], 400)
        );
    }
}
