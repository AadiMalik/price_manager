<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_without_hash')->nullable();
            $table->string('image_url')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('website_url')->nullable();
            $table->string('phone_no')->nullable();
            $table->date('activation_date')->nullable();
            $table->string('validity_day')->nullable();
            $table->unsignedBigInteger('user_type')->nullable();
//            $table->unsignedBigInteger('user_rating')->nullable();
            $table->unsignedBigInteger('user_package')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->date('expiry_date')->nullable();
            $table->unsignedBigInteger('view')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
