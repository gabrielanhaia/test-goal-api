<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Model de usuários.
 *
 * @package App
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'description', 'access_type_id', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the access type of user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function accessType()
    {
        return $this->hasOne(AccessType::class, 'id', 'access_type_id');
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->accessType()->first()->type === 'admin';
    }

    /**
     * The projects that belong to the users.
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project')
            ->withTimestamps();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
