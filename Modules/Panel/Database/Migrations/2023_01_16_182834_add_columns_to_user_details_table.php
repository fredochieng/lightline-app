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
        Schema::table('user_details', function (Blueprint $table) {
            $table->bigInteger('marital_status_id')->after('gender')->nullable();
            $table->bigInteger('education_level_id')->after('marital_status_id')->nullable();
            $table->bigInteger('race_id')->after('education_level_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('marital_status_id');
            $table->dropColumn('education_level_id');
            $table->dropColumn('race_id');
        });
    }
};
