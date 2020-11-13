<?php

namespace App\Listeners;

use App\Events\EventResolved;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\ServiceController;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\ServiceGroupController;

class ResetServices
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventResolved  $event
     * @return void
     */
    public function handle(EventResolved $event)
    {
        //$serviceController = new ServiceController;
        //$serviceGroupController = new ServiceGroupController;
        $services = $event->event->services;
        $serviceGroups = $event->event->serviceGroups;



        foreach($services as $service) {
            $service->resetStatus();
            //app()->call('App\Http\Controllers\ServiceController@resetStatus', [$service]);
            //$serviceController->resetStatus($service);
        }

        foreach($serviceGroups as $serviceGroup) {
            $serviceGroup->resetStatus();
            //app()->call('App\Http\Controllers\ServiceGroupController@resetStatus', [$serviceGroup]);
            //$serviceGroupController->resetStatus($serviceGroup);
        }
    }
}
