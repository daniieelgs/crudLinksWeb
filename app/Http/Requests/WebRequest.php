<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class WebRequest extends FormRequest
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
            'name' => 'required',
            'url' => 'required',
            'description' => 'required'
        ];
    }

    public function withValidator(Validator $validator)
   {

      $url = strtoupper($validator->getData()['url'] ?? '');
      $validator->after(
        function ($validator) use ($url){
            if (!preg_match("/[A-Z0-9]+\.[A-Z0-9]+/i", strtoupper($url))) {
                $validator->errors()->add(
                    'url',
                    'URL incorrecte.'
                );
            }
        }
      );
   }

}
