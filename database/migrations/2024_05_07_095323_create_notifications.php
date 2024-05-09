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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->date('send_date');
            $table->string('title');
            $table->text('notification_detail');
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('cso_id')->nullable();
            $table->unsignedBigInteger('name_changes_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('registration_id')->nullable();
            $table->unsignedBigInteger('address_changes_id')->nullable();
            $table->unsignedBigInteger('support_letter_id')->nullable();
            $table->timestamps();

            $table->foreign('cso_id')->references('id')->on('csos')->onDelete('set null');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('set null');
            $table->foreign('name_changes_id')->references('id')->on('namechanges')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('set null');
            $table->foreign('address_changes_id')->references('id')->on('addresschanges')->onDelete('set null');
            $table->foreign('support_letter_id')->references('id')->on('support_letters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
