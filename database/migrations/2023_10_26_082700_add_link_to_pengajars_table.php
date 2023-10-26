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
        Schema::table('pengajars', function (Blueprint $table) {
            $table->string('pddikti')->nullable()->after('gambar');
            $table->string('sinta')->nullable()->after('pddikti');
            $table->string('scholar')->nullable()->after('sinta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajars', function (Blueprint $table) {
            $table->dropColumn('pddikti');
            $table->dropColumn('sinta');
            $table->dropColumn('scholar');
        });
    }
};
