<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    // use HasFactory;
    protected $table = 'tbl_login';

    protected $fillable = [
        'username',
        'pass',
        'role'
    ];

    protected $hidden = [
        'pass',
    ];

    public function getAuthPassword(){
        return $this->pass;
    }

}
