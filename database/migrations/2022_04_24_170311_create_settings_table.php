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
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id')->default(1)->unique();

            $table->string('website_title');
            $table->string('website_description');

            $table->string('primary_color');
            $table->string('hover_color');
            $table->string('transparent_color');

            $table->string('email');
            $table->string('address');
            $table->string('phone1');
            $table->string('phone2');

            $table->string('logo');
            $table->string('favicon');

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();

            $table->string('currency');

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
        Schema::dropIfExists('settings');
    }
};
