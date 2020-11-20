<?php

namespace App\Http\Resources;

use App\Models\Status;
use App\Http\Resources\Status as StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ServiceGroup as ServiceGroupResource;

class Service extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $serviceGroups = array();
        foreach($this->groups as $group) {
            $serviceGroups[] = ['id' => $group->id,
                                'name' => $group->name,
                                'description' => $group->description,
                                'sort_order' => $group->sort_order];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'default_status' => new StatusResource(Status::find($this->default_status_id)),
            'current_status' => new StatusResource(Status::find($this->current_status_id)),
            'service_groups' => $serviceGroups,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
