<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = 'rumah_sakit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama_rsu',
        'jenis_rumah_sakit',
        'kode_pos',
        'website',
        'email',
        'alamat',
        'latitude',
        'longitude',
        'kode_kelurahan',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['location', 'telepon', 'faximile', 'kecamatan', 'kota'];

    public function getLocationAttribute()
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }

    public function getTeleponAttribute()
    {
        $telps = [];
        foreach(Telepon::where('rumah_sakit_id', $this->id)->get() as $telp){
            $telps[] = $telp->no_telepon;
        }
        return $telps;
    }

    public function getKecamatanAttribute()
    {
        $data = $this->with(['kelurahan.kecamatan' => function($q){
            $q->select('kode_kecamatan', 'nama_kecamatan');
        }])->first();

        $kecamatan = $data->kelurahan->kecamatan;

        return $kecamatan;
    }

    public function getKotaAttribute()
    {
        $data = $this->with(['kelurahan.kecamatan.kota' => function($q){
            $q->select('kode_kota', 'nama_kota');
        }])->first();

        $kota = $data->kelurahan->kecamatan->kota;

        return $kota;
    }

    public function getFaximileAttribute()
    {
        $faxs = [];
        foreach(Faximile::where('rumah_sakit_id', $this->id)->get() as $fax){
            $faxs[] = $fax->no_faximile;
        }
        return $faxs;
    }

    public function kelurahan()
    {
        return $this->belongsTo("App\Models\Kelurahan", "kode_kelurahan", "kode_kelurahan");
    }

    public function telepon()
    {
        return $this->hasMany("App\Models\Telepon");
    }

    public function faximile()
    {
        return $this->hasMany("App\Models\Faximile");
    }

}
