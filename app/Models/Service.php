<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'default_status_id', 'current_status_id', 'service_group_id'];

    public function currentStatus() {
        return $this->hasOne(Status::class, 'current_status_id');
    }

    public function defaultStatus() {
        return $this->hasOne(Status::class, 'default_status_id');
    }

    public function groups() {
        return $this->belongsToMany(ServiceGroup::class, 'service_group_assignments', 'service', 'service_group');
    }
}
