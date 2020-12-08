<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\Service as ServiceResource;

define('STATUS_OPERATIONAL', 1);
define('STATUS_DEGRADED',    2);
define('STATUS_OUTAGE',      3);
define('STATUS_MAINTENANCE', 4);

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        return response(ServiceResource::collection(Service::all())->toJson(JSON_PRETTY_PRINT), 200);
    }

    public function summary() {
        return Status::summaryMessage();
        //return "Moodle Workplace performance degraded.";

        $services = Service::all();
        $operational = array();
        $degraded = array();
        $outage = array();
        $maintenance = array();

        foreach($services as $service) {
            $operational[] = $service->currentStatus()->id == STATUS_OPERATIONAL ? $service->name : null;
            $degraded[] = $service->currentStatus()->id == STATUS_DEGRADED ? $service->name : null;
            $outage[] = $service->currentStatus()->id == STATUS_OUTAGE ? $service->name : null;
            $maintenance[] = $service->currentStatus()->id == STATUS_MAINTENANCE ? $service->name : null;
        }

        $operational = array_filter($operational);
        $degraded = array_filter($degraded);
        $outage = array_filter($outage);
        $maintenance = array_filter($maintenance);

        print_r($operational);
        print_r($degraded);
        print_r($outage);
        print_r($maintenance);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
