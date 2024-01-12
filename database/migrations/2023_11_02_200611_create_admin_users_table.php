<?php
// database/migrations/<timestamp>_create_admin_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fcm_token')->nullable(); // Add an FCM token column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
