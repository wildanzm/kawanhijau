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
        Schema::table('petani_profiles', function (Blueprint $table) {
            $table->decimal('farm_size', 10, 2)->nullable()->after('address');
            $table->enum('farming_experience', ['beginner', 'intermediate', 'experienced', 'expert'])->nullable()->after('farm_size');
            $table->string('farm_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('petani_profiles', function (Blueprint $table) {
            $table->dropColumn(['farm_size', 'farming_experience']);
        });
    }
};
