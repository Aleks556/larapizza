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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('role_id')->default(1);
            $table->foreignId('user_id');
            $table->integer('phone_number');
            $table->string('address_street');
            $table->string('address_number');
            $table->string('address_flat');
            $table->string('address_zipcode');
            $table->string('address_city');
            $table->integer('student')->default(0);
            $table->integer('shift_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
