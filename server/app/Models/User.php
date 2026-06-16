<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use MongoDB\Laravel\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'cartItems',
        'resetPasswordOTP',
        'resetPasswordOTPExpiry',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'cartItems' => 'array',
        'password' => 'hashed',
        'resetPasswordOTPExpiry' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->getKey(),
        ];
    }
}
