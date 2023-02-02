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
        Schema::create('product_attribute_value', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id')->index();
            $table->foreign('job_id')->references('id')->on('jobs')->cascadeOnDelete();
            $table->unsignedBigInteger('attribute_value_id')->index();
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->cascadeOnDelete();
            $table->primary(['job_id', 'attribute_value_id']);
            $table->unsignedInteger('sort_order')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_attribute_value');
    }
};
