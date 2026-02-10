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
            $table->dropIndex('user_guest_likes_author_type_author_id_index');
        });

        DB::statement('ALTER TABLE user_guest_likes MODIFY author_id CHAR(36) NULL');

        Schema::table('user_guest_likes', function (Blueprint $table) {
            $table->index(['author_type', 'author_id']);
        });
    }

    public function down(): void
    {
        Schema::table('user_guest_likes', function (Blueprint $table) {
            $table->dropIndex('user_guest_likes_author_type_author_id_index');
        });

        DB::statement('ALTER TABLE user_guest_likes MODIFY author_id BIGINT UNSIGNED NULL');

        Schema::table('user_guest_likes', function (Blueprint $table) {
            $table->index(['author_type', 'author_id']);
        });
    }
};
