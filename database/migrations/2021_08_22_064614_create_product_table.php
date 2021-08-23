<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->boolean('popular');
            $table->integer('quantity');
            $table->double('original_price');
            $table->double('discount');
            $table->double('final_price');
            $table->string('image');
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
        Schema::dropIfExists('product');
    }
}
