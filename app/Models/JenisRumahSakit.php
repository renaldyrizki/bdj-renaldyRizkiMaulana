<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRumahSakit extends Model
{
    use HasFactory;

    protected $table = 'jenis_rumah_sakit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_rsu',
    ];

}
