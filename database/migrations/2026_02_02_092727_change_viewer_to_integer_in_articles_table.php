<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update non-numeric values to 0
        DB::statement("UPDATE articles SET viewer = 0 WHERE viewer IS NULL OR viewer = '' OR viewer NOT REGEXP '^[0-9]+$'");
        
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('viewer')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('viewer')->nullable()->change();
        });
    }
};
