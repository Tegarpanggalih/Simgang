<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatPKL extends Model
{
    protected $table = 'tbl_sertifikat_pkl';

    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap', 'asal_sekolah', 'nim_nis', 'tempat_lahir', 
        'tgl_lahir', 'jurusan', 'tgl_mulai', 'tgl_selesai', 
        'tgl_sertifikat', 'nm_pembimbing', 'nik_pembimbing', 
        'jabatan_pembimbing', 'no_sertifikat', 'nm_kadis', 'nip_kadis', 
        'aprove_pembimbing', 'approve_kadis', 'sts_diambil'
    ];

    protected $dates = ['tgl_lahir', 'tgl_mulai', 'tgl_selesai', 'tgl_sertifikat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim_nis', 'username');
    }
}
