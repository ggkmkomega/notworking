<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Admin extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use HasFactory;
    use Authenticatable;
    use Authorizable;

    protected $fillable = [
        'fname',
        'lname',
        'role',
        'email',
        'authname',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
