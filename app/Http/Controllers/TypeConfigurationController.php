<?php

namespace App\Http\Controllers;

use App\Models\TypeConfiguration;
use App\Http\Requests\StoreTypeConfigurationRequest;
use App\Http\Requests\UpdateTypeConfigurationRequest;

class TypeConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeConfigurationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeConfigurationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeConfiguration  $typeConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(TypeConfiguration $typeConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeConfiguration  $typeConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeConfiguration $typeConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeConfigurationRequest  $request
     * @param  \App\Models\TypeConfiguration  $typeConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeConfigurationRequest $request, TypeConfiguration $typeConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeConfiguration  $typeConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeConfiguration $typeConfiguration)
    {
        //
    }
}
