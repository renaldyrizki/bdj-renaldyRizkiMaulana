<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_kelurahan', 'nama_kelurahan', 'kode_kecamatan'
    ];

    public function kecamatan()
    {
        return $this->belongsTo("App\Models\Kecamatan", "kode_kecamatan", "kode_kecamatan");
    }
}
