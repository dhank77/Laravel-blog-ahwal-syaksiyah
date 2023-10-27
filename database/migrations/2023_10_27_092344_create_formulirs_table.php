<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('formulirs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug');
            $table->tinyInteger('is_aktif')->default(0);
            $table->tinyInteger('param1')->nullable();
            $table->tinyInteger('param2')->nullable();
            $table->tinyInteger('param3')->nullable();
            $table->tinyInteger('param4')->nullable();
            $table->tinyInteger('param5')->nullable();
            $table->tinyInteger('param6')->nullable();
            $table->tinyInteger('param7')->nullable();
            $table->tinyInteger('param8')->nullable();
            $table->tinyInteger('param9')->nullable();
            $table->tinyInteger('file1')->nullable();
            $table->tinyInteger('file2')->nullable();
            $table->tinyInteger('file3')->nullable();
            $table->tinyInteger('file4')->nullable();
            $table->tinyInteger('file5')->nullable();
            $table->string('param_nama1')->nullable();
            $table->string('param_nama2')->nullable();
            $table->string('param_nama3')->nullable();
            $table->string('param_nama4')->nullable();
            $table->string('param_nama5')->nullable();
            $table->string('param_nama6')->nullable();
            $table->string('param_nama7')->nullable();
            $table->string('param_nama8')->nullable();
            $table->string('param_nama9')->nullable();
            $table->string('file_nama1')->nullable();
            $table->string('file_nama2')->nullable();
            $table->string('file_nama3')->nullable();
            $table->string('file_nama4')->nullable();
            $table->string('file_nama5')->nullable();
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
        Schema::dropIfExists('formulirs');
    }
};
