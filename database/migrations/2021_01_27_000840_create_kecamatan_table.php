<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->char('kode_kecamatan', 7)->primary();
            $table->string('nama_kecamatan', 50);
            $table->char('kode_kota', 4);
            $table->timestamps();
            $table->foreign('kode_kota')
                    ->references('kode_kota')
                    ->on('kota')
                    ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kecamatan');
    }
}
