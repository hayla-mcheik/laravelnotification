<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudiesFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titleone' => [
                'required',
                'string'
            ],
            'descone' => [
                'required',
                'string'
            ],
            'titletwo' => [
                'required',
                'string'
            ],
            'desctwo' => [
                'required',
                'string'
            ],
            'titlethree' => [
                'required',
                'string'
            ],
            'descthree' => [
                'required',
                'string'
            ],
            'textone' => [
                'required',
                'string'
            ],
            'texttwo' => [
                'required',
                'string'
            ],
            'textthree' => [
                'required',
                'string'
            ],
            'spanone' => [
                'required',
                'string'
                ],
                 'spantwo' => [
                'required',
                'string'
                ],
                      'spanthree' => [
                'required',
                'string'
                ],
            'disclaimer' => [
                'required',
                'string'
            ],
            'color' => [
                'required',
                'string'
            ],
            'status' =>[
                'nullable'
            ],
            'image' => [
                'nullable',
                
            ]
        ];
    }
}
