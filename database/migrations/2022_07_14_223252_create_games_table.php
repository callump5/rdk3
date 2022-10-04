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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->required();
            $table->string('image_path')->nullable();;
            $table->float('price', 8, 2)->nullable();
            $table->text('description')->nullable();;
            $table->string('type')->nullable();


            $table->float('cdkeys_price', 8, 2)->nullable();
            $table->string('cdkeys_link')->unique()->nullable();
            $table->float('g2a_price', 8, 2)->nullable();
            $table->string('g2a_link')->unique()->nullable();
            $table->longText('g2a_search_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
