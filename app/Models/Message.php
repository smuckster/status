<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'event_id', 'response_id'];

    /** Eloquent relationships */
    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function response() {
        return $this->hasOne(Response::class);
    }
}
