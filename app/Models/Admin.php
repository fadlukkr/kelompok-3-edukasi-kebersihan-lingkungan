<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    protected $primaryKey = 'id_admin';

    public $timestamps = false; // Ubah ke true jika migrasi admin Anda menggunakan timestamps()

    protected $fillable = [
        'nama_admin',
        'email',
        'password_hash',
        'status',
    ];

    protected $hidden = [
        'password_hash',
    ];

    // Menyesuaikan kolom password agar terbaca oleh sistem Auth Laravel
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Relasi: Satu admin bisa membuat banyak data edukasi
    public function edukasis()
    {
        return $this->hasMany(Edukasi::class, 'id_admin', 'id_admin');
    }
}
