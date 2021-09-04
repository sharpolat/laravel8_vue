<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNestedCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nested_comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->string('user_display_name')->nullable();
            $table->timestamps();

            $table->foreignId('post_id')->constrained()->nullable()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->nullable();
            $table->foreignId('comment_id')->constrained()->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nested_comments');
    }
}
