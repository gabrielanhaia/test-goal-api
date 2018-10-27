<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model de tipos de acesso do usuário.
 * @package App
 */
class AccessType extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'access_type_id', 'id');
    }
}
