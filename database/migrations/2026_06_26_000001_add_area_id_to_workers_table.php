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
        if (! Schema::hasColumn('workers', 'area_id')) {
            Schema::table('workers', function (Blueprint $table) {
                $table->foreignId('area_id')->nullable()->after('age')->constrained('areas')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('workers', 'area_id')) {
            Schema::table('workers', function (Blueprint $table) {
                $table->dropConstrainedForeignId('area_id');
            });
        }
    }
};
