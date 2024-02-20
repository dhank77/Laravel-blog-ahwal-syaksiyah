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
        Schema::table('formulirs', function (Blueprint $table) {
            $table->date("batas_pendaftaran")->nullable()->after("is_aktif");
            $table->integer("maks_pendaftar")->default(0)->after("batas_pendaftaran");
            $table->longText("pesan_selesai")->nullable()->after("maks_pendaftar");
            $table->tinyInteger("is_tampil")->default(0)->after("pesan_selesai");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulirs', function (Blueprint $table) {
            $table->dropColumn("batas_pendaftaran");
            $table->dropColumn("maks_pendaftar");
            $table->dropColumn("pesan_selesai");
            $table->dropColumn("is_tampil");
        });
    }
};
