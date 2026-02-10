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
        Schema::table('document_reports', function (Blueprint $table) {
            $table->string('original_filename')->nullable()->after('report');
        });

        Schema::table('annual_reports', function (Blueprint $table) {
            $table->string('original_filename')->nullable()->after('report');
        });

        Schema::table('financial_reports', function (Blueprint $table) {
            $table->string('original_filename')->nullable()->after('report');
        });

        Schema::table('investor_reports', function (Blueprint $table) {
            $table->string('original_filename')->nullable()->after('report');
        });

        Schema::table('stock_reports', function (Blueprint $table) {
            $table->string('original_filename')->nullable()->after('report');
        });

        Schema::table('shareholder_reports', function (Blueprint $table) {
            $table->string('original_filename')->nullable()->after('report');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_reports', function (Blueprint $table) {
            $table->dropColumn('original_filename');
        });

        Schema::table('annual_reports', function (Blueprint $table) {
            $table->dropColumn('original_filename');
        });

        Schema::table('financial_reports', function (Blueprint $table) {
            $table->dropColumn('original_filename');
        });

        Schema::table('investor_reports', function (Blueprint $table) {
            $table->dropColumn('original_filename');
        });

        Schema::table('stock_reports', function (Blueprint $table) {
            $table->dropColumn('original_filename');
        });

        Schema::table('shareholder_reports', function (Blueprint $table) {
            $table->dropColumn('original_filename');
        });
    }
};
