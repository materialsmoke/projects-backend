<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'user_id', 'working_time_seconds', 'total_entries'];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
