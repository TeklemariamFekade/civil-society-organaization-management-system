<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('namechanges', function (Blueprint $table) {
            $table->id();
            $table->string('new_english_name');
            $table->string('new_amharic_name');
            $table->string('cso_file');
            $table->date('send_date');
            $table->unsignedBigInteger('cso_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->timestamps();
            $table->foreign('cso_id')->references('id')->on('csos')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_changes');
    }
};
