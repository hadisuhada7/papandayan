<?php

use App\Models\CorporateSocial;
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
        if (!Schema::hasColumn('corporate_socials', 'slug')) {
            Schema::table('corporate_socials', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // Generate slugs for existing social posts
        $socials = CorporateSocial::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($socials as $social) {
            $social->slug = CorporateSocial::generateUniqueSlug($social->title, $social->id);
            $social->save();
        }

        // Add unique constraint (drop first if exists to avoid errors)
        try {
            Schema::table('corporate_socials', function (Blueprint $table) {
                $table->dropUnique(['slug']);
            });
        } catch (\Exception $e) {
            // Index doesn't exist, continue
        }

        Schema::table('corporate_socials', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('corporate_socials', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
