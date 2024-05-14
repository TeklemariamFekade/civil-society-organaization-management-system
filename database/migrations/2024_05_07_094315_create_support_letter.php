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
        Schema::create('support_letters', function (Blueprint $table) {
            $table->id();
            $table->date('send_date');
            $table->string('cso_file');
            $table->unsignedBigInteger('cso_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();
            $table->foreign('cso_id')->references('id')->on('csos')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
        });
        //thjmsfjckem,d
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_letter');
    }
};
