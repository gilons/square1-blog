<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class PostValidator 
{

    static public function validateCreatePost($data)
    {
        $rules = [
            'title' => 'string|required',
            'content' => 'string|required',
        ];

        return Validator::make($data, $rules);
    }

}
