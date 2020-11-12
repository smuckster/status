<?php

namespace App\Http\Controllers;

use App\Models\ServiceGroup;
use Illuminate\Http\Request;

class ServiceGroupController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serviceGroup = ServiceGroup::create($request->all());

        return redirect('/servicegroups/' . $serviceGroup->id);
    }

    public function allocate(Request $request, ServiceGroup $serviceGroup) {
        $serviceGroup->services()->attach($request->service);
    }

    public function deallocate(Request $request, ServiceGroup $serviceGroup) {
        $serviceGroup->services()->detach($request->service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceGroup  $serviceGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceGroup $serviceGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceGroup  $serviceGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceGroup $serviceGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceGroup  $serviceGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceGroup $serviceGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceGroup  $serviceGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceGroup $serviceGroup)
    {
        //
    }
}
