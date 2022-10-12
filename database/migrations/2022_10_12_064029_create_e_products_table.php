<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->integer('price')->default(0);
            $table->bigInteger('brand_id')->nullable();
            $table->longText('description')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
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
        Schema::dropIfExists('e_products');
    }
}
