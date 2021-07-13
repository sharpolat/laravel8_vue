<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParserForKrishasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parser_for_krishas', function (Blueprint $table) {
            $table->id();
            $table->integer('last_parser_id')->nullable();
            $table->integer('ad_id')->nullable();
            $table->integer('offer__price')->nullable();
            $table->string('offer__location offer__advert-short-info')->nullable();
            $table->string('offer__info-title')->nullable();
            $table->integer('offer__advert-short-info')->nullable();

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
        Schema::dropIfExists('parser_for_krishas');
    }
}
