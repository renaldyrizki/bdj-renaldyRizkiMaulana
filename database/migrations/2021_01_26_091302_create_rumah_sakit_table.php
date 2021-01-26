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
            $table->string('nama_rsu');
            $table->integer('kode_pos');
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->bigInteger('jenis_rumah_sakit_id')->unsigned();
            $table->char('kode_kelurahan');
            $table->timestamps();
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
