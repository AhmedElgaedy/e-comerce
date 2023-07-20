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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->default('default.png');
            $table->integer('quantity');
            $table->integer('category_id');

            $table->double('price_before_discount');
            $table->double('discount');
            $table->double('price_after_discount');

            $table->boolean('best_selling')->default(0);
            $table->boolean('best_offer')->default(0);

            $table->longText('description')->nullable();
            $table->double('total_rate')->nullable();
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
        Schema::dropIfExists('products');
    }
};
