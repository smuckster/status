<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Status;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.index')->with(['services' => Service::all()]);
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
        $request->validate(['name' => 'required']);

        /** If there's no sort order attached, set it to the highest sort value */
        if(empty($request->sort_order)) {
            $highestSortOrder = Service::orderBy('sort_order', 'desc')
                ->first()
                ->sort_order ?? 0;

            $service = Service::make($request->all());
            $service->sort_order = $highestSortOrder + 1;
            $service->save();
        } else {
            $service = Service::create($request->all());
        }

        return redirect('/services' . $service->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', ['service' => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->name = $request->name;
        $service->description = $request->description;
        $service->default_status_id = $request->default_status_id;
        $service->current_status_id = $request->current_status_id;
        $service->sort_order = $request->sort_order;

        $service->save();

        return redirect('/services/' . $service->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        Service::destroy($service->id);

        return redirect('/services');
    }

    public function setStatus(Service $service, Status $status) {
        $service->current_status_id = $status->id;

        $service->save();
    }

    public function resetStatus(Service $service) {
        $service->current_status_id = $service->default_status_id;

        $service->save();
    }
}
