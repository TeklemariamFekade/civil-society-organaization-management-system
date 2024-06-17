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
        Schema::create('address_changes', function (Blueprint $table) {
            $table->id();
            $table->string('place_of_work');
            $table->string('country');
            $table->string('region');
            $table->string('zone');
            $table->string('woreda');
            $table->string('kebele');
            $table->string('district');
            $table->string('phone_no');
            $table->string('po_box')->nullable();
            $table->string('email');
            $table->string('cso_file');
            $table->date('send_date');
            $table->unsignedBigInteger('cso_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->timestamps();

            $table->foreign('cso_id')->references('id')->on('csos')->cascadeOnDelete();
            $table->foreign('service_id')->references('id')->on('services')->nullOnDelete();;
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_changes');
    }
};
