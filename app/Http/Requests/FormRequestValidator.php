<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestValidator extends FormRequest
{

    protected $rules = [

    ];

    public function rules()
    {
        return $this->rules;
    }
}