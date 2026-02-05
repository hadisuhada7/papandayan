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
        // Ensure existing data is numeric before altering the column type
        DB::statement(<<<SQL
            UPDATE initiatives
            SET viewer = 0
            WHERE viewer IS NULL
                OR viewer = ''
                OR viewer NOT REGEXP '^[0-9]+$'
        SQL);

        Schema::table('initiatives', function (Blueprint $table) {
            $table->unsignedBigInteger('viewer')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('initiatives', function (Blueprint $table) {
            $table->string('viewer')->nullable()->change();
        });
    }
};
