<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_kecamatan', 'nama_kecamatan', 'kode_kota'
    ];

    public function kota()
    {
        return $this->belongsTo("App\Models\Kota", "kode_kota", "kode_kota");
    }
}
