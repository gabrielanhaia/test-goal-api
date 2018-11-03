<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** @var array $fillable */
    protected $fillable = [
        'name', 'album_id', 'saved_name', 'uid', 'type'
    ];
}
