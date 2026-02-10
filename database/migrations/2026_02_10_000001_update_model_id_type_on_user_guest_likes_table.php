<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_guest_likes', function (Blueprint $table) {
            $table->dropIndex('user_guest_likes_model_type_model_id_index');
        });

        DB::statement('ALTER TABLE user_guest_likes MODIFY model_id CHAR(36) NOT NULL');

        Schema::table('user_guest_likes', function (Blueprint $table) {
            $table->index(['model_type', 'model_id']);
        });
    }

    public function down(): void
    {
        Schema::table('user_guest_likes', function (Blueprint $table) {
            $table->dropIndex('user_guest_likes_model_type_model_id_index');
        });

        DB::statement('ALTER TABLE user_guest_likes MODIFY model_id BIGINT UNSIGNED NOT NULL');

        Schema::table('user_guest_likes', function (Blueprint $table) {
            $table->index(['model_type', 'model_id']);
        });
    }
};
