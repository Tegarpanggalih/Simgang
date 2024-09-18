<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_login';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'pass',
        'role',
    ];

    protected $hidden = [
        'pass',
        'remember_token',
    ];

    public $timestamps = false; // Menonaktifkan timestamps

    public function sertifikats()
    {
        return $this->hasMany(SertifikatPKL::class, 'nim_nis', 'username');
    }

    public function getAuthPassword()
    {
        return $this->pass;
    }
}
