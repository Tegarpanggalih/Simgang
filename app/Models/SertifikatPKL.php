<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatPKL extends Model
{
    protected $table = 'tbl_sertifikat_pkl';
    protected $primaryKey = 'id_sertifikat';


    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap', 'asal_sekolah', 'nim_nis', 'tempat_lahir', 
        'tgl_lahir', 'jurusan', 'tgl_mulai', 'tgl_selesai', 
        'tgl_sertifikat', 'nm_pembimbing', 'nik_pembimbing', 
        'jabatan_pembimbing','bidang', 'no_sertifikat', 'nm_kadis', 'nip_kadis', 
        'aprove_pembimbing', 'approve_kadis', 'sts_diambil'
    ];

    protected $casts = [
        'tgl_lahir' => 'date:Y-m-d', 
        'tgl_mulai' => 'date:Y-m-d', 
        'tgl_selesai'=> 'date:Y-m-d', 
        'tgl_sertifikat' => 'date:Y-m-d'];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim_nis', 'username');
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_sertifikat', 'id_sertifikat');
    }
}
