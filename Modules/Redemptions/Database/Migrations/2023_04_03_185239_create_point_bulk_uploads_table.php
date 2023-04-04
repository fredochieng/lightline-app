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
        Schema::create('point_bulk_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('reason');
            $table->string('csv_filename');
            $table->string('unique_file_name');
            $table->boolean('csv_header')->default(0);
            $table->longText('csv_data');
            $table->string('upload_processed')->default('No');
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
        Schema::dropIfExists('point_bulk_uploads');
    }
};
