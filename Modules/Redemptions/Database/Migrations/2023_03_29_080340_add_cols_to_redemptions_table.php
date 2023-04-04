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
        Schema::table('redemptions', function (Blueprint $table) {
            $table->string('request_id')->after('status')->nullable()->unique();
            $table->string('amount_sent')->after('request_id')->nullable();
            $table->string('at_dsc')->after('amount_sent')->nullable();
            $table->string('phone_sent_to')->after('at_dsc')->nullable();
            $table->string('at_status')->after('phone_sent_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('redemptions', function (Blueprint $table) {
            $table->dropColumn('request_id');
            $table->dropColumn('amount_sent');
            $table->dropColumn('at_dsc');
            $table->dropColumn('phone_sent_to');
            $table->dropColumn('at_status');
        });
    }
};
