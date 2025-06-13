<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enclosure_id')->constrained()->onDelete('cascade'); // связь с enclosure
            $table->string('name');
            $table->enum('gender', ['m', 'f']); // пол
            $table->unsignedTinyInteger('age')->default(0); // возраст 0-30
            $table->unsignedTinyInteger('satiety')->default(100); // сытость 0–100
            $table->boolean('is_alive')->default(true); // жив ли животное
            $table->string('class');   // mammal, reptile, и т.д.
            $table->string('species'); // gazelle, bear, и т.д.
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
        Schema::dropIfExists('animals');
    }
}
