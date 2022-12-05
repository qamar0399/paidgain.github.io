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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->double('commission_rate')->nullable();
            $table->string('name');
            $table->double('price')->nullable();
            $table->integer('ad_limit');
            $table->integer('status');
            $table->integer('days');
            $table->integer('is_trial');
            $table->boolean('user_can_post')->default(false);
            $table->text('data')->nullable();
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
        Schema::dropIfExists('plans');
    }
};
