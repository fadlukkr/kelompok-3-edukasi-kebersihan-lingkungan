<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    protected $table = 'edukasi';

    protected $primaryKey = 'id_edukasi';

    public $timestamps = true; // Sesuai dengan migrasi sebelumnya yang menggunakan $table->timestamps();

    protected $fillable = [
        'judul_edukasi',
        'isi_materi',
        'tanggal_upload',
        'id_admin',
    ];

    // Relasi: Setiap edukasi ditulis/dibuat oleh satu admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
