<?php

namespace App\Http\Resources;

use App\Traits\DateFormatTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'workingTimeSeconds' => DateFormatTrait::secondsToHoursMinutesSeconds($this->working_time_seconds),
            "totalEntries" => $this->total_entries,
            "isStopped" => $this->is_stopped,
        ];
    }
}
