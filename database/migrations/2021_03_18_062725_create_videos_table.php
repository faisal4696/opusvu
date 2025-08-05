<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('title_spanish');
            $table->string('title_french');
            $table->longText('description')->nullable();
            $table->longText('description_spanish')->nullable();
            $table->longText('description_french')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('attachment')->nullable();
            $table->string('subtitle_english')->nullable();
            $table->string('subtitle_spanish')->nullable();
            $table->string('subtitle_french')->nullable();
            $table->time('duration')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
