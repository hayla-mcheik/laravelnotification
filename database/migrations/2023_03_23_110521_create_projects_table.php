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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('slug');
            $table->string('titletwo')->nullable();
            $table->mediumText('description');
            $table->tinyInteger('status')->default('0')->comment('1=hidden,0=visible');
            $table->tinyInteger('featured')->default('0')->comment('0=hidden,1=visible');
            $table->string('width')->default('40%');
            $table->string('class');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('projects');
    }
};
