<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    protected $primaryKey = 'id_jawaban';

    protected $fillable = ['id_masyarakat', 'skor', 'status_kelulusan'];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'id_masyarakat', 'id_masyarakat');
    }
}
