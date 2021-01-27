<?php

namespace App\Console\Commands;

use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Telepon;
use App\Models\Faximile;
use App\Models\RumahSakit;
use Illuminate\Console\Command;

class InitData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function getWilayah(){
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'http://api.jakarta.go.id/v1/kelurahan', [
            'headers' => [
                'Accept'     => 'application/json',
                'Authorization'      => env('TOKEN_BDJ', ''),
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $result = [];
        if ($statusCode===200){
            $body = json_decode($body);
            $result = @$body->data;
        }

        return $result;
    }

    private function getRumahSakit(){
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'http://api.jakarta.go.id/v1/rumahsakitumum', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => env('TOKEN_BDJ', ''),
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $result = [];
        if ($statusCode===200){
            $body = json_decode($body);
            $result = @$body->data;
        }

        return $result;
    }

    private function saveWilayah()
    {
        $datas = $this->getWilayah();

        foreach($datas as $data){
            $kodeProvinsi = $data->kode_provinsi;
            $namaProvinsi = $data->nama_provinsi;

            $provinsi = Provinsi::firstOrCreate([
                'kode_provinsi' => $kodeProvinsi,
            ], [
                'kode_provinsi' => $kodeProvinsi,
                'nama_provinsi' => $namaProvinsi,
            ]);

            $kodeKota = $data->kode_kota;
            $namaKota = $data->nama_kota;

            $kota = Kota::firstOrCreate([
                'kode_kota' => $kodeKota,
            ], [
                'kode_kota' => $kodeKota,
                'nama_kota' => $namaKota,
                'kode_provinsi' => $provinsi->kode_provinsi,
            ]);

            $kodeKecamatan = $data->kode_kecamatan;
            $namaKecamatan = $data->nama_kecamatan;

            $kecamatan = Kecamatan::firstOrCreate([
                'kode_kecamatan' => $kodeKecamatan,
            ], [
                'kode_kecamatan' => $kodeKecamatan,
                'nama_kecamatan' => $namaKecamatan,
                'kode_kota' => $kota->kode_kota,
            ]);

            $kodeKelurahan = $data->kode_kelurahan;
            $namaKelurahan = $data->nama_kelurahan;

            $kelurahan = Kelurahan::firstOrCreate([
                'kode_kelurahan' => $kodeKelurahan,
            ], [
                'kode_kelurahan' => $kodeKelurahan,
                'nama_kelurahan' => $namaKelurahan,
                'kode_kecamatan' => $kecamatan->kode_kecamatan,
            ]);
        }
    }

    private function saveRumahSakit()
    {
        $datas = $this->getRumahSakit();

        foreach($datas as $data){

            $rumahSakit = RumahSakit::firstOrCreate([
                'id' => $data->id,
            ], [
                'id' => $data->id,
                'nama_rsu' => $data->nama_rsu,
                'jenis_rumah_sakit' => $data->jenis_rsu,
                'kode_pos' => $data->kode_pos,
                'website' => $data->website,
                'email' => $data->email,
                'alamat' => $data->location->alamat,
                'latitude' => $data->location->latitude,
                'longitude' => $data->location->longitude,
                'kode_kelurahan' => $data->kode_kelurahan,
            ]);

            foreach($data->telepon as $telepon){
                $telp = Telepon::firstOrCreate(
                    [
                        'no_telepon' => $telepon,
                        'rumah_sakit_id' => $data->id,
                    ],
                    [
                        'no_telepon' => $telepon,
                        'rumah_sakit_id' => $data->id,
                    ]
                );
            }

            foreach($data->faximile as $faximile){
                $telp = Faximile::firstOrCreate(
                    [
                        'no_faximile' => $faximile,
                        'rumah_sakit_id' => $data->id,
                    ],
                    [
                        'no_faximile' => $faximile,
                        'rumah_sakit_id' => $data->id,
                    ]
                );
            }
        }
    }

    public function handle()
    {
        $this->saveWilayah();
        $this->saveRumahSakit();

        $this->info('Success...');
    }
}
