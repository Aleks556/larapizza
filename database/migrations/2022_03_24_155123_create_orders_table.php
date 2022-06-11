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
    //przerobic na zeby bylo bez id adresu
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('address_id');
            $table->double('price');
            $table->string('comment')->nullable();
            $table->boolean('payment');
            $table->integer('status')->default(1);
            $table->integer('phone_number');
            //dane adresowe
            $table->integer('delivery')->default(0);
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('flat')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
