<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admins extends Authenticatable
{
    //
    use HasRoles;

    protected $guard_name='web';

    protected $fillable = ['name','password','email'];
}
