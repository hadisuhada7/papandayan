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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('location');
            $table->date('posting_at');
            $table->date('closing_at');
            $table->text('qualification');
            $table->text('description');
            $table->string('work_type');
            $table->string('work_experience');
            $table->string('status');
            $table->string('thumbnail');
            $table->softDeletes();
            $table->timestamps();
        });

        // Add foreign key to career_applicants table
        Schema::table('career_applicants', function (Blueprint $table) {
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key from career_applicants table first
        Schema::table('career_applicants', function (Blueprint $table) {
            $table->dropForeign(['career_id']);
        });

        Schema::dropIfExists('careers');
    }
};
