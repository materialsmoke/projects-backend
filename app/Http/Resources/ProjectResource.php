<?php

namespace App\Http\Resources;

use App\Traits\DateFormatTrait;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            
            "id" => $this->id,
            "userId" => $this->user_id,
            'name' => $this->name,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
            "totalWorkingTime" => DateFormatTrait::secondsToHoursMinutesSeconds($this->working_time_seconds),
            'entries' => EntryResource::collection($this->entries),
            "user" => new UserResource($this->user),
        ];
    }
}
