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

    /** Logic */
    public static function summaryMessage() {
        $statuses = Status::all();
        $message = "All systems operational.";
        $serviceStatuses = array();

        foreach($statuses as $status) {
            foreach($status->services as $service) {
                $serviceStatuses[$service->name] = $status->id;
            }
        }

        $notOperational = array_filter($serviceStatuses, function($serviceStatus) {
            return ! Status::find($serviceStatus)->isDefault();
        });

        if(sizeof($notOperational) > 0) {
            $message = Status::createStatusMessage($notOperational);
        }

        return $message;
    }

    protected static function getDefault() {
        return Status::where('isDefault', 1)->first()->id;
    }

    /**
     * @param array $serviceStatuses ['Service Name' => <status id>]
     * @return string $message
     */
    protected static function createStatusMessage(array $serviceStatuses) {
        $message = '';
        $singularVerb = ' has ';
        $pluralVerb = ' have ';

        $message =  Status::commaSeparatedList(array_keys($serviceStatuses));
        $message .= (sizeof($serviceStatuses) == 1) ? $singularVerb : $pluralVerb;
        $message .= "degraded performance.";

        return $message;
    }

    protected static function commaSeparatedList(array $items) {
        $message = "";
        //dd($items);
        for($i = 0; $i < sizeof($items); $i++) {
            $message .= ' ' . $items[$i];

            // If this is not the last item and the list does not contain two items
            if((sizeof($items) - 1) != $i && sizeof($items) != 2) {
                $message .= ",";
            }
            // If this is the second to last item
            if($i == (sizeof($items) - 2)) {
                $message .= " and";
            }
        }
        return trim($message);
    }

    public function isDefault() {
        return (Status::getDefault() == $this->id) ? true : false;
    }

}
