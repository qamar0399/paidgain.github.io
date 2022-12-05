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
        Schema::create('ptcs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('ads_type'); // link_url, image, youtube_subscriber, script_code, 'embedded, facebook_follower, twitter_follower, instagram_follower
            $table->text('ads_body');
            $table->string('slug')->unique();
            $table->double('amount')->nullable();
            $table->integer('duration')->default(0);
            $table->integer('max_limit')->default(0);
            $table->integer('is_clickable')->default(0);
            $table->integer('status')->default(1); //1 = active 0 = paused
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ptcs');
    }
};
