<?php

use App\Models\Initiative;
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
        // Add slug column if it doesn't exist
        if (!Schema::hasColumn('initiatives', 'slug')) {
            Schema::table('initiatives', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // Generate slugs for existing initiatives
        $initiatives = Initiative::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($initiatives as $initiative) {
            $initiative->slug = Initiative::generateUniqueSlug($initiative->title, $initiative->id);
            $initiative->save();
        }

        // Add unique constraint (drop first if exists to avoid errors)
        try {
            Schema::table('initiatives', function (Blueprint $table) {
                $table->dropUnique(['slug']);
            });
        } catch (\Exception $e) {
            // Index doesn't exist, continue
        }

        Schema::table('initiatives', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('initiatives', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
