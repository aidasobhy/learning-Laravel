<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table='admins';
    protected $fillable=['id','name','email','password'];

    protected $hidden=['password'];

    protected $guard="admin";



}
