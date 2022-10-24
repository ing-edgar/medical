<?php

namespace App\Services;

use Illuminate\Http\Request;

interface Requestable
{
    public function build(Request $request);
}
