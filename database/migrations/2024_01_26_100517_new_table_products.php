<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableProducts extends Migration
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
            $table->text('description');
            $table->text('info');
            $table->decimal('price', 8, 2)->nullable();
            $table->text('link');
            $table->json('images'); // Armazenar as URLs das imagens em um formato JSON, ou ajuste conforme necessário
            $table->json('rooms'); // Armazenar as URLs das imagens em um formato JSON, ou ajuste conforme necessário
            $table->json('keys'); // Armazenar as URLs das imagens em um formato JSON, ou ajuste conforme necessário
            $table->timestamps();
            $table->softDeletes(); // Adiciona a coluna deleted_at
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
