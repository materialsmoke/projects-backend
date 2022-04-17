<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'start', 'end', 'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
