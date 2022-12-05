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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //user id
            $table->unsignedBigInteger('getway_id'); //user id
            $table->string('trx')->nullable();
            $table->double('amount')->nullable();
            $table->double('totalamount')->nullable();
            $table->string('currency')->nullable();
            $table->integer('status')->nullable();
            $table->integer('payment_status')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('getway_id')
                ->references('id')->on('getways')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
};
