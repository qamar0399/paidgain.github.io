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
        Schema::create('withdraw_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->double('min_limit', 2)->nullable();
            $table->double('max_limit', 2)->default(0);
            $table->string('delay')->nullable();
            $table->double('fixed_charge', 2)->nullable();
            $table->double('rate', 2)->nullable();
            $table->double('percent_charge', 2)->nullable();
            $table->string('currency')->nullable();
            $table->json('user_data')->nullable();
            $table->text('instruction')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('withdraw_methods');
    }
};
