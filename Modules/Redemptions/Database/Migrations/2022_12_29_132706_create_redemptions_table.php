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
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->string('redemption_no');
            $table->bigInteger('user_id');
            $table->bigInteger('points_redeemed');
            $table->string('expected_date');
            $table->string('date_paid')->nullable();
            $table->bigInteger('payment_mode');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('redemptions');
    }
};
