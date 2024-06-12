<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_id')->constrained()->onDelete('cascade');
            $table->string('carrier_code');
            $table->string('origin');
            $table->string('destination');
            $table->timestamp('departure_time');
            $table->timestamp('arrival_time');
            $table->decimal('price', 8, 2);
            $table->string('currency', 3);
            $table->timestamps();
            $table->boolean('return_flight')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
