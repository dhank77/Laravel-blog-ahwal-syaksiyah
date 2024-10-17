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
        Schema::create('soal_surveys', function (Blueprint $table) {
            $table->id();
            $table->text("soal");
            $table->string("pilihan1")->nullable();
            $table->string("pilihan2")->nullable();
            $table->string("pilihan3")->nullable();
            $table->string("pilihan4")->nullable();
            $table->string("pilihan5")->nullable();
            $table->tinyInteger("is_active")->default(1);
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
        Schema::dropIfExists('soal_surveys');
    }
};
