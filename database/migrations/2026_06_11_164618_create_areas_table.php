<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

   public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('description');
            $table->time('punctuality')->nullable();
            $table->time('departure')->nullable();
            $table->timestamps();
        });

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
        Schema::dropIfExists('areas');
    }
};

