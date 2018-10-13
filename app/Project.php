<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'address', 'description'
    ];

    /**
     * The users that belong to the project.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')
            ->withTimestamps();
    }
}
