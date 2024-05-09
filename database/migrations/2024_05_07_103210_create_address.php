<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('place_of_work');
            $table->string('country_of_origin');
            $table->string('country');
            $table->string('region');
            $table->string('zone');
            $table->string('woreda');
            $table->string('district');
            $table->string('kebele');
            $table->string('phone_no');
            $table->string('po_box'); // Modified column name
            $table->string('email');
            $table->unsignedBigInteger('cso_id');
            $table->foreign('cso_id')->references('id')->on('csos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
