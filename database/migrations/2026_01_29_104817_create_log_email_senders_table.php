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
        Schema::create('log_email_senders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ticket_id')->nullable()->constrained()->nullOnDelete();
            $table->string('recipient_email');
            $table->string('subject');
            $table->string('template');
            $table->string('status')->default('queued');
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_email_senders');
    }
};
