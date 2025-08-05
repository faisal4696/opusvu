<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['on','off'])->default('off');
            $table->unsignedBigInteger('video_id');
            $table->string('title');
            $table->string('title_spanish');
            $table->string('title_french');
            $table->longText('description')->nullable();
            $table->longText('description_spanish')->nullable();
            $table->longText('description_french')->nullable();
            $table->string('image');
            $table->string('video');
            $table->timestamps();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
