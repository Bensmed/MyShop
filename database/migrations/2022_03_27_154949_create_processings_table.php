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
        Schema::create('processings', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_address');
            $table->string('client_wilaya');
            $table->string('client_commune');
            $table->string('client_phone');
            $table->string('amount');
            $table->string('status');
            $table->string('order_details');
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
        Schema::dropIfExists('processings');
    }
};
