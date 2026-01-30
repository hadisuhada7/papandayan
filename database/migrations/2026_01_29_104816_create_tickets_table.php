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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('question_id')->nullable()->constrained()->nullOnDelete();
            $table->string('subject');
            $table->text('message');
            $table->string('requester_name');
            $table->string('requester_email');
            $table->string('requester_phone')->nullable();
            $table->string('status')->default('new');
            $table->string('priority')->default('normal');
            $table->string('channel')->default('website');
            $table->text('response_message')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
