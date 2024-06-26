<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museum', function (Blueprint $table) {
            $table->id();
            $table->string('namamuseum');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('jambuka');
            $table->string('jamtutup');
            $table->string('biayamasuk');
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
        Schema::dropIfExists('museum');
    }
};
