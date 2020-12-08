<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Service;
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
        /** If there's no sort order attached, set it to the highest sort value */
        if(empty($request->sort_order)) {
            $highestSortOrder = ServiceGroup::orderBy('sort_order', 'desc')
                ->first()
                ->sort_order ?? 0;

            $serviceGroup = ServiceGroup::make($request->all());
            $serviceGroup->sort_order = $highestSortOrder + 1;
            $serviceGroup->save();
        } else {
            $serviceGroup = ServiceGroup::create($request->all());
        }

        return redirect('/servicegroups/' . $serviceGroup->id);
    }

    public function allocate(ServiceGroup $serviceGroup, Service $service) {
        //$serviceGroup->services()->attach($service);
        $serviceGroup->allocateService($service);
    }

    public function deallocate(ServiceGroup $serviceGroup, Service $service) {
        //$serviceGroup->services()->detach($service);
        $serviceGroup->deallocateService($service);
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
        $serviceGroup->name = $request->serviceGroup->name;
        $serviceGroup->description = $request->serviceGroup->description;

        $serviceGroup->save();

        return redirect('/servicegroups/' . $serviceGroup->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceGroup  $serviceGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceGroup $serviceGroup)
    {
        ServiceGroup::destroy($serviceGroup->id);

        return redirect('/servicegroups');
    }

    public function setStatus(ServiceGroup $serviceGroup, Status $status) {
        $services = $serviceGroup->services;
        foreach($services as $service) {
            $service->current_status_id = $status->id;
            $service->save();
        }
    }

    public function resetStatus(ServiceGroup $serviceGroup) {
        $services = $serviceGroup->services;
        foreach($services as $service) {
            $service->current_status_id = $service->default_status_id;
            $service->save();
        }
    }
}
