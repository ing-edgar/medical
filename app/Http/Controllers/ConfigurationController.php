<?php

namespace App\Http\Controllers;

use App\Models\ConfigType;
use App\Models\User;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::select('id', 'name')->with(['configurations' => function ($query) {
            $query->select('configurations.id');
        }])->findOrFail($request->get('user_id'));
        // Buscamos los tipos de configuración
        $configurationType = ConfigType::select('id', 'label', 'input_type')->get();

        return response()->json([
            'config_user' => $user,
            'configuration_types' => $configurationType
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->addConfiguration($request->configurations);

        return response()->json('La configuración se ha guardado exitósamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
