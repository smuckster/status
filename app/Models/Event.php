<?php

namespace App\Models;

use App\Events\EventResolved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'current_response_id', 'resolved_at'];

    /** Eloquent relationships */
    public function services() {
        return $this->belongsToMany(Service::class, 'event_services');
    }

    public function serviceGroups() {
        return $this->belongsToMany(ServiceGroup::class, 'event_service_groups', 'service_group_id', 'event_id');
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }

    /** Logic */
    public function resolve() {
        $this->resolved_at = now();
        $this->save();

        event(new EventResolved($this));
    }

    public function updateResponse($response) {
        $this->current_response_id = $response->id;
        $this->save();
    }

    public function allocateService(Service $service) {
        $this->services()->attach($service);
    }

    public function deallocateService(Service $service) {
        $this->services()->detach($service);
    }

    public function allocateServiceGroup(ServiceGroup $serviceGroup) {
        $this->serviceGroups()->attach($serviceGroup);
    }

    public function deallocateServiceGroup(ServiceGroup $serviceGroup) {
        $this->serviceGroups()->detach($serviceGroup);
    }

    public function addMessage($message) {
        //$this
    }

    /** Factory methods for fluent API */
    public function withServices($count = 0) {
        $services = Service::factory()->count($count)->create();
        foreach($services as $service) {
            $this->allocateService($service);
        }

        return $this;
    }

    public function withServiceGroups($count = 0) {
        $serviceGroups = ServiceGroup::factory()->count($count)->create();
        foreach($serviceGroups as $serviceGroup) {
            $this->allocateServiceGroup($serviceGroup);
        }

        return $this;
    }

    public function withMessages($count = 0) {
        Message::factory()->state(['event_id' => $this->id])->count($count)->create();

        return $this;
    }
}
