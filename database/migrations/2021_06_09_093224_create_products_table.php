<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('uuid');
            $table->string('name');
            $table->string('slug');
            $table->double('regular_price')->default(0);
            $table->enum('discount_type', ['amount', 'percentage'])->nullable();
            $table->unsignedBigInteger('discount')->default(0);
            $table->enum('unit_type', ['kg', 'pcs'])->nullable();
            $table->unsignedBigInteger('unit')->default(0);
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->string('product_image')->nullable();
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
}
