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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->unsignedBigInteger('withdraw_method_id')->nullable(); //TODO:: maybe delete by project manager
            $table->unsignedBigInteger('user_id');
            $table->double('amount')->nullable();
            $table->integer('charge');
            $table->integer('rate');
            $table->string('currency');
            $table->text('commant')->nullable();
            $table->string('status')->default('pending'); //pending, completed, failed
            $table->timestamps();
            $table->foreign('withdraw_method_id')->references('id')->on('withdraw_methods')->onDelete('cascade');
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
        Schema::dropIfExists('withdraws');
    }
};
