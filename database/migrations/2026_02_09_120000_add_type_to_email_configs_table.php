<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('email_configs', function (Blueprint $table) {
            $table->string('type')->default('ticket')->after('name');
        });

        DB::table('email_configs')
            ->whereNull('type')
            ->update(['type' => 'ticket']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_configs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
