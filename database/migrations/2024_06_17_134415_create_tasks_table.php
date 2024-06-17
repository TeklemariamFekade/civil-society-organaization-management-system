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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->date('due_date');
            $table->string('status')->default('not start');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('registration_id')->nullable();
            $table->unsignedBigInteger('name_changes_id')->nullable();
            $table->unsignedBigInteger('address_changes_id')->nullable();
            $table->unsignedBigInteger('support_letter_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('set null');
            $table->foreign('name_changes_id')->references('id')->on('namechanges')->onDelete('set null');
            $table->foreign('address_changes_id')->references('id')->on('address_changes')->onDelete('set null');
            $table->foreign('support_letter_id')->references('id')->on('support_letters')->onDelete('set null');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
