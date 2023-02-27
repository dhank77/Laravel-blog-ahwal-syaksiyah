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
        Schema::create('komponens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('komponen1');
            $table->string('komponen2')->nullable();
            $table->string('komponen3')->nullable();
            $table->string('komponen4')->nullable();
            $table->string('komponen5')->nullable();
            $table->string('komponen6')->nullable();
            $table->string('komponen7')->nullable();
            $table->string('komponen8')->nullable();
            $table->string('komponen9')->nullable();
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
        Schema::dropIfExists('komponens');
    }
};
