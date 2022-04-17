<?php

namespace App\Http\Resources;

use App\Traits\DateFormatTrait;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $differenceInSecond = 0;
        if(!is_null($this->end)){
            $start = Carbon::make($this->start);
            $end = Carbon::make($this->end);
            $differenceInSecond = $end->diffInSeconds($start);
        }
        
        return [
            'start' => $this->start,
            'end' => $this->end,
            'timeSpent' => DateFormatTrait::secondsToHoursMinutesSeconds($differenceInSecond),
            'projectId' => $this->project_id
        ];
    }
}
