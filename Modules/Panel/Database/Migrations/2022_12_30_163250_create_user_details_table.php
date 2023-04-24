<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('panel_no');
            $table->string('phone_number');
            $table->string('country_code');
            $table->string('dob')->nullable();
            $table->bigInteger('age')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('country_code')
                ->references('country_code')->on('countries')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('user_details');
    }
};
