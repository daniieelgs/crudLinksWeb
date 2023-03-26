<?php

namespace App\Http\Requests;

use App\Models\Web;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class WebRequestCreate extends WebRequest
{


    private function nameExists($name){

        return count(array_filter(Web::all()->toArray(), fn($n) => $n['name'] == $name)) > 0;
    }

    public function withValidator(Validator $validator)
   {

        parent::withValidator($validator);

        $name = $validator->getData()['name'];

        $validator->after(
        function ($validator) use ($name){

            if($this->nameExists($name)){
                $validator->errors()->add(
                    'name',
                    'Aquest nom ja está registrat.'
                );
            }

        }
        );

   }

}
