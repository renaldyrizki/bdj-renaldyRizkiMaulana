<?php
require_once 'vendor/autoload.php';

define("TOKEN", "LdT23Q9rv8g9bVf8v/fQYsyIcuD14svaYL6Bi8f9uGhLBVlHA3ybTFjjqe+cQO8k");

function getWilayah($area='kelurahan', $idKelurahan){
    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', 'http://api.jakarta.go.id/v1/'.$area.'/'.$idKelurahan, [
        'headers' => [
            'Accept'     => 'application/json',
            'Authorization'      => TOKEN,
        ]
    ]);

    $statusCode = $response->getStatusCode();
    $body = $response->getBody()->getContents();
    $result = [];
    if ($statusCode===200){
        $body = json_decode($body);
        $result = @$body->data[0] ? @$body->data[0] : [];
    }

    return $result;
}


function mergeAPI(){
    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', 'http://api.jakarta.go.id/v1/rumahsakitumum', [
        'headers' => [
            'Accept'     => 'application/json',
            'Authorization'      => TOKEN,
        ]
    ]);

    $statusCode = $response->getStatusCode();
    $body = $response->getBody()->getContents();
    $result = [];
    if ($statusCode===200){
        $body = json_decode($body);
        
        foreach($body->data as $data){
            $kodeKelurahan = $data->kode_kelurahan;
            $kelurahan = getWilayah('kelurahan', $kodeKelurahan);
            $kodeKecamatan = $data->kode_kecamatan;
            $kecamatan = getWilayah('kecamatan', $kodeKecamatan);
            $kodeKota = $data->kode_kota;
            $kota = getWilayah('kota', $kodeKota);

            $result[] = [
                'id' => $data->id,
                'nama_rsu' => $data->nama_rsu,
                'jenis_rsu' => $data->jenis_rsu,
                'location' => [
                    'latitude' => $data->location->latitude,
                    'longitude' => $data->location->longitude,
                ],
                'alamat' => $data->location->alamat,
                'kode_pos' => $data->kode_pos,
                'telepon' => $data->telepon,
                'faximile' => $data->faximile,
                'website' => $data->website,
                'email' => $data->email,
                'kelurahan' => [
                    'kode' => $kodeKelurahan,
                    'nama' => $kelurahan->nama_kelurahan,
                ],
                'kecamatan' => [
                    'kode' => $kodeKecamatan,
                    'nama' => $kecamatan->nama_kecamatan,
                ],
                'kota' => [
                    'kode' => $kodeKota,
                    'nama' => $kota->nama_kota,
                ],
            ];
        }
    }

    return $result;
}

$a = mergeAPI();
var_dump($a);