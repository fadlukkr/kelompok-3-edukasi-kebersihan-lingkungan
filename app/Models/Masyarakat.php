<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    protected $table = 'masyarakat';

    protected $primaryKey = 'id_masyarakat';

    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password_hash',
        'status',
        'alamat',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}