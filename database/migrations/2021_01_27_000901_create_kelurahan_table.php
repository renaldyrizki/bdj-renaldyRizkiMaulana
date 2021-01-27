<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->char('kode_kelurahan', 10)->primary();
            $table->string('nama_kelurahan', 50);
            $table->char('kode_kecamatan');
            $table->timestamps();
            $table->foreign('kode_kecamatan')
                    ->references('kode_kecamatan')
                    ->on('kecamatan')
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
        Schema::dropIfExists('kelurahan');
    }
}
