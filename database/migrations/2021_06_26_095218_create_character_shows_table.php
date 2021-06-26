<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_shows', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->text('body')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            

            $table->foreignId('character_id')->constrained()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_shows');
    }
}


