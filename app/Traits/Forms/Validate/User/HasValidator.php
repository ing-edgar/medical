<?php

namespace App\Traits\Forms\Validate\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait HasValidator
{
    public function validator(array $data, $id = null)
    {
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ])->validate();
    }
}
