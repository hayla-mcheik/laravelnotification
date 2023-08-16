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
        Schema::create('agency_desc_video', function (Blueprint $table) {
            $table->id();
            $table->text('agencydescr');
            $table->text('video');
            $table->text('title');
            $table->text('agencytitle');
            $table->text('agencydesc');
            $table->text('agencytitletwo');
            $table->text('agencydesctwo');
            $table->text('agencytitlethree');
            $table->text('agencydescthree');
            $table->text('agencytitlefour');
            $table->text('agencydescfour');
            $table->text('animattext');
            $table->text('gettrs');
            $table->text('getrsdesc');
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
        Schema::dropIfExists('agency_desc_video');
    }
};
