<?php

namespace App\Traits\Forms\Request\Article;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait HasRequestData
{
    public function build(Request $request)
    {
        return [
            'title' => $request->title,
            'alias' => Str::slug($request->title),
            'description' => $request->description
        ];
    }
}
