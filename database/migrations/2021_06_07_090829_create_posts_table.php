<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->unsignedBigInteger('view_count');
            $table->text('body');
            $table->string('tags')->nullable();
            $table->integer('comment_count');
            $table->timestamps();

            $table->foreignId('post_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
