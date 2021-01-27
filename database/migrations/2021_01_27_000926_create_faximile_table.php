<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaximileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faximile', function (Blueprint $table) {
            $table->id();
            $table->string('no_faximile', 50);
            $table->timestamps();
            $table->foreignId('rumah_sakit_id')
                    ->constrained('rumah_sakit')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faximile');
    }
}
