<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accommodation_id');
            $table->string('path');
            $table->string('name');
            $table->timestamps();
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodation_photos');
    }
}
