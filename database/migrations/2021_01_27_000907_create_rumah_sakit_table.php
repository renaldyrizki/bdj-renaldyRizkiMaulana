<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumahSakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumah_sakit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rsu', 50);
            $table->string('jenis_rumah_sakit', 50);
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->string('alamat', 255);
            $table->string('kode_pos', 5);
            $table->string('website', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->char('kode_kelurahan',10);
            $table->timestamps();
            $table->foreign('kode_kelurahan')
                    ->references('kode_kelurahan')
                    ->on('kelurahan')
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
        Schema::dropIfExists('rumah_sakit');
    }
}
