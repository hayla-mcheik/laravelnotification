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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->text('subsc_text');
            $table->text('subsc_footer');
            $table->text('loca_dubai');
            $table->text('loca_beirut');
            $table->text('email_join');
            $table->text('email_work');
            $table->text('dubai_phone');
            $table->text('beirut_phone');
            $table->text('faceb');
            $table->text('insta');
            $table->text('twitter');
            $table->text('linkedin');
            $table->text('youtube');
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
        Schema::dropIfExists('contact');
    }
};
