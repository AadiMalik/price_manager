<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleBricksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_bricks', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle');
            $table->integer('sale_rate');
            $table->integer('qty');
            $table->integer('purchase_rate');
            $table->string('bill_no');
            $table->bigInteger('vender_id')->unsigned()->nullable();
            $table->foreign('vender_id')->references('id')->on('users');
            $table->bigInteger('code')->unsigned()->nullable();
            $table->foreign('code')->references('code')->on('customers');
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('sale_bricks');
    }
}
