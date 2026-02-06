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
        Schema::table('products', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('link_whatsapp');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('link_whatsapp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('icon');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
