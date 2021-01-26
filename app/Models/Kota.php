<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kota';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_kota', 'nama_kota', 'kode_provinsi'
    ];

    public function provinsi()
    {
        return $this->belongsTo("App\Models\Provinsi", "kode_provinsi", "kode_provinsi");
    }
}
