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
        Schema::create('csos', function (Blueprint $table) {
            $table->id();
            $table->string('english_name');
            $table->string('amharic_name');
            $table->date('date_of_established');
            $table->string('type');
            $table->string('category');
            $table->boolean('current_status')->default(false);
            $table->string('approvalNumber')->nullable();
            $table->string('cso_file');
            $table->string('status')->default('apply');
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('representative_id');
            $table->timestamps();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('set null');
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csos');
    }
};
