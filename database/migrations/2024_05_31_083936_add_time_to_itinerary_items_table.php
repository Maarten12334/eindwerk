<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeToItineraryItemsTable extends Migration
{
    public function up()
    {
        Schema::table('itinerary_items', function (Blueprint $table) {
            $table->time('time')->nullable(); // Adding the time column
        });
    }

    public function down()
    {
        Schema::table('itinerary_items', function (Blueprint $table) {
            $table->dropColumn('time');
        });
    }
}
