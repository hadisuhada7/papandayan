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
        Schema::table('menu_navigations', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['menu_group_id']);
            
            // Modify the column to be nullable
            $table->foreignId('menu_group_id')->nullable()->change();
            
            // Add the foreign key constraint back with nullable support
            $table->foreign('menu_group_id')->references('id')->on('menu_groups')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_navigations', function (Blueprint $table) {
            // Drop the nullable foreign key constraint
            $table->dropForeign(['menu_group_id']);
            
            // Change back to not nullable
            $table->foreignId('menu_group_id')->change();
            
            // Add the foreign key constraint back
            $table->foreign('menu_group_id')->references('id')->on('menu_groups')->onDelete('cascade');
        });
    }
};
