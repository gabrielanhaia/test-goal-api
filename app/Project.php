<?php

namespace App;

use App\Album;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'address', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function albums()
    {
        return $this->hasMany(Album::class)->orderBy('updated_at');
    }
}
