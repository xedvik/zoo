<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnclosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('enclosures', function (Blueprint $table) {
            $table->id(); // id вольера
            $table->string('type'); // forest, water, desert, savanna
            $table->boolean('is_open')->default(true); // открыт ли вольер
            $table->boolean('is_locked')->default(false); // закрыт ли вольер
            $table->boolean('has_roof')->default(false); // есть ли крыша
            $table->string('food_type'); // meat, fish, insects, grass
            $table->integer('food_amount')->default(0); // 0–500
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
        Schema::dropIfExists('enclosures');
    }
}
