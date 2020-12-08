<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'sort_order'];

    public function services() {
        return $this->belongsToMany(Service::class, 'service_group_assignments', 'service_group', 'service');
    }

    public function resetStatus() {
        $services = $this->services;
        foreach($services as $service) {
            $service->resetStatus();
        }
    }

    public function allocateService(Service $service) {
        $this->services()->attach($service);
    }

    public function deallocateService(Service $service) {
        $this->services()->detach($service);
    }
}
