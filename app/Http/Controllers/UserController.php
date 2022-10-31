<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfessionals()
    {
        return response()->json(User::select('id', 'name')->get(), 200, [], JSON_NUMERIC_CHECK);
    }
}
