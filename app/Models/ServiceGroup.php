<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function services() {
        return $this->belongsToMany(Service::class, 'service_group_assignments', 'service_group', 'service');
    }

    public function resetStatus() {
        $services = $this->services();
        foreach($services as $service) {
            $service->resetStatus();
        }
    }
}
