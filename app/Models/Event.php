<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'current_response_id', 'resolved_at'];

    public function services() {
        return $this->belongsToMany(Service::class, 'event_services');
    }

    public function serviceGroups() {
        return $this->belongsToMany(ServiceGroup::class, 'event_service_groups', 'service_group_id', 'event_id');
    }
}
