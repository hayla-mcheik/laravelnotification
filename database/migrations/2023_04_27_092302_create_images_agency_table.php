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
        Schema::create('images_agency', function (Blueprint $table) {
            $table->id();
            $table->text('imageone');
            $table->text('imagetwo');
            $table->text('imagethree');
            $table->text('imagefour');
            $table->text('imagefive');
            $table->text('imagesix');
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
        Schema::dropIfExists('images_agency');
    }
};
