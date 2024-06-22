<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('itineraries', function (Blueprint $table) {
            $table->string('random_key', 16)->unique()->after('id');
        });
    }

    public function down()
    {
        Schema::table('itineraries', function (Blueprint $table) {
            $table->dropColumn('random_key');
        });
    }
};
