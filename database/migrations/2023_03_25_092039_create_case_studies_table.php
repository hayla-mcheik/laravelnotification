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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->text('titleone');
            $table->text('descone');
            $table->text('titletwo');
            $table->text('desctwo');
            $table->text('titlethree');
            $table->text('descthree');
            $table->text('textone');

            $table->text('texttwo');

            $table->text('textthree');

            $table->text('disclaimer');
            $table->text('color');
            $table->tinyInteger('status')->default('0')->comment('1=hidden,0=visible');
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
        Schema::dropIfExists('case_studies');
    }
};
