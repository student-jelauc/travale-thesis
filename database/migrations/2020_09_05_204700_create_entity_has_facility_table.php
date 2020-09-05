<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityHasFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_has_facility', function (Blueprint $table) {
            $table->string('entity_id');
            $table->string('entity_type');
            $table->unsignedBigInteger('facility_id');
            $table->timestamps();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_has_facility');
    }
}
