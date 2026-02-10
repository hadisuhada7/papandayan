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
        Schema::create('career_applicants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('phone_number');
            $table->date('bod');
            $table->string('education');
            $table->string('major')->nullable();
            $table->string('experienced');
            $table->unsignedBigInteger('current_salary')->nullable();
            $table->unsignedBigInteger('expectation_salary')->nullable();
            $table->string('status');
            $table->text('reject_reason')->nullable();
            $table->string('curriculum_vitae');
            $table->foreignUuid('career_id')->constrained('careers')->onDelete('cascade');
            $table->foreignUuid('experienced_id')->nullable()->constrained('experienced_applicants')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_applicants');
    }
};
