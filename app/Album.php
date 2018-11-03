<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /** @var array $fillable */
    protected $fillable = [
        'name',
        'project_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsTo('App\Project')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(\App\Photo::class)->orderBy('updated_at');
    }
}
