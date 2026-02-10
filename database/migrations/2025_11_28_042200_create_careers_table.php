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
            $table->uuid('id')->primary();
            $table->string('position');
            $table->string('location');
            $table->date('posting_at');
            $table->date('closing_at');
            $table->text('qualification');
            $table->text('description');
            $table->string('work_type');
            $table->string('work_experience');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
