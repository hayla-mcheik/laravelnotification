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
        Schema::create('_case__studies__images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('casestudies_id');
            $table->string('image');
            $table->foreign('casestudies_id')->references('id')->on('case_studies')->onDelete('cascade');
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
        Schema::dropIfExists('_case__studies__images');
    }
};
