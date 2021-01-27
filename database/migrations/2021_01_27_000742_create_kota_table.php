<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kota', function (Blueprint $table) {
            $table->char('kode_kota', 4)->primary();
            $table->string('nama_kota', 50);
            $table->char('kode_provinsi');
            $table->timestamps();
            $table->foreign('kode_provinsi')
                    ->references('kode_provinsi')
                    ->on('provinsi')
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
        Schema::dropIfExists('kota');
    }
}
