<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';
    protected $primaryKey = 'id_absen';

    protected $fillable = [
        'idpegawai',
        'masuk',
        'tgl_absen',
        'kondisi',
        'keterangan',
        'shift',
        'jobdesk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'idpegawai','idpegawai');
    }

    public function timeshift()
    {
        return $this->belongsTo(Timeshift::class,'shift','id');
    }

}
