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
        Schema::create('log_download_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('type_report');
            $table->string('ip_address')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('downloaded_at')->nullable();
            $table->foreignId('document_report_id')->nullable()->constrained('document_reports')->onDelete('cascade');
            $table->foreignId('annual_report_id')->nullable()->constrained('annual_reports')->onDelete('cascade');
            $table->foreignId('financial_report_id')->nullable()->constrained('financial_reports')->onDelete('cascade');
            $table->foreignId('investor_report_id')->nullable()->constrained('investor_reports')->onDelete('cascade');
            $table->foreignId('stock_report_id')->nullable()->constrained('stock_reports')->onDelete('cascade');
            $table->foreignId('shareholder_report_id')->nullable()->constrained('shareholder_reports')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_download_reports');
    }
};
