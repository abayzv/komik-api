<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('alt_title');
            $table->string('slug');
            $table->string('genre');
            $table->string('type');
            $table->string('colour');
            $table->string('rating');
            $table->string('illustrator');
            $table->string('comic_type');
            $table->string('graphic');
            $table->integer('viewers');
            $table->string('status');
            $table->string('theme');
            $table->string('img');
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
        Schema::dropIfExists('comics');
    }
}
