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
            $table->integer('user_id');
            $table->integer('registration_id')->nullable();
            $table->integer('name_changes_id')->nullable();
            $table->integer('address_changes_id')->nullable();
            $table->integer('support_letter_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('registration_id')->references('id')->on('registrations')->cascadeOnDelete();
            $table->foreign('name_changes_id')->references('id')->on('name_changes')->cascadeOnDelete();
            $table->foreign('address_changes_id')->references('id')->on('address_changes')->cascadeOnDelete();
            $table->foreign('support_letter_id')->references('id')->on('support_letters')->cascadeOnDelete();
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
