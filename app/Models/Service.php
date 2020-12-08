<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'default_status_id', 'current_status_id', 'sort_order'];

    /** Eloquent relationships */
    public function currentStatus() {
        return Status::find($this->current_status_id);
    }

    public function defaultStatus() {
        return Status::find($this->default_status_id);
    }

    public function groups() {
        return $this->belongsToMany(ServiceGroup::class, 'service_group_assignments', 'service', 'service_group');
    }

    public function events() {
        return $this->belongsToMany(Event::class);
    }

    /** Logic */
    public function resetStatus() {
        $this->current_status_id = $this->default_status_id;
        $this->save();
    }

    public function allocateToGroup(ServiceGroup $serviceGroup) {
        $serviceGroup->services()->attach($this);
    }

    public function deallocateFromGroup(ServiceGroup $serviceGroup) {
        $serviceGroup->services()->detach($this);
    }
}
