<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Message;
use App\Models\Service;
use App\Models\ServiceGroup;
use Illuminate\Http\Request;
use App\Events\EventResolved;

class EventController extends Controller
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
        $event = Event::create($request->all());

        return redirect('/events/', $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->name = $request->name;
        $event->description = $request->description;

        $event->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function resolve(Event $event) {
        $event->resolve();
    }

    public function allocateService(Event $event, Service $service) {
        $event->allocateService($service);
    }

    public function deallocateService(Event $event, Service $service) {
        $event->deallocateService($service);
    }

    public function allocateServiceGroup(Event $event, ServiceGroup $serviceGroup) {
        $event->allocateServiceGroup($serviceGroup);
    }

    public function deallocateServiceGroup(Event $event, ServiceGroup $serviceGroup) {
        $event->deallocateServiceGroup($serviceGroup);
    }
}
