<?php

namespace App\Traits\Forms\Validate\Article;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait HasValidator
{
    public function validator(array $data, $id = null)
    {
        Validator::make($data, [
            'title' => [
                'required',
                Rule::unique('articles')->ignore($id)
            ],
            'alias' => [
                Rule::unique('articles')->ignore($id)
            ]
        ])->validate();
    }
}
