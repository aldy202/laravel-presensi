<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeshift extends Model
{
    use HasFactory;

    protected $table = 'timeshift';


    protected $fillable = [
        'presensi_mulai',
        'presensi_selesai',
        'shift',
    ];

    public function presensi()
    {
        return $this->hasMany(Presensi::class,'shift','id');
    }

}

