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
        Schema::create('data_details', function (Blueprint $table) {
            $table->id();
            $table->string('data_id');
            $table->string('nim')->nullable();
            $table->string('nama')->nullable();
            $table->string('param1')->nullable();
            $table->string('param2')->nullable();
            $table->string('param3')->nullable();
            $table->string('param4')->nullable();
            $table->string('param5')->nullable();
            $table->string('param6')->nullable();
            $table->string('param7')->nullable();
            $table->string('param8')->nullable();
            $table->string('param9')->nullable();
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
        Schema::dropIfExists('data_details');
    }
};
