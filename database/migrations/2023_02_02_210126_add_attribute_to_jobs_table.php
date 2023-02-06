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
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('gender_id')->index()->nullable();
            $table->foreign('gender_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->unsignedBigInteger('work_time_id')->index()->nullable();
            $table->foreign('work_time_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->unsignedBigInteger('experience_id')->index()->nullable();
            $table->foreign('experience_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->unsignedBigInteger('education_id')->index()->nullable();
            $table->foreign('education_id')->references('id')->on('attribute_values')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['gender_id', 'work_time_id', 'education_id', 'experience_id']);
        });
    }
};
