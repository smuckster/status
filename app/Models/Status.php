<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'color'];

    public function services() {
        return $this->hasMany(Service::class, 'current_status_id');
    }
}
