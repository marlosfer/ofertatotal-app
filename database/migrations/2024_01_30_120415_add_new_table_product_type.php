<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableProductType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Use unsignedBigInteger for foreign keys
            $table->unsignedBigInteger('type_id');    // Use unsignedBigInteger for foreign keys
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('type_id')->references('id')->on('types'); // Assuming 'types' is the correct table name
            $table->timestamps(); // Instead of 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_type');
    }
}
