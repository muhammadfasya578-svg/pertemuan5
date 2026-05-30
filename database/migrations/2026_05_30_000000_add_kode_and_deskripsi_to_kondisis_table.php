<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kondisis', function (Blueprint $table) {
            if (! Schema::hasColumn('kondisis', 'kode')) {
                $table->string('kode', 20)->unique()->after('id');
            }
            if (! Schema::hasColumn('kondisis', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('badge_color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kondisis', function (Blueprint $table) {
            if (Schema::hasColumn('kondisis', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
            if (Schema::hasColumn('kondisis', 'kode')) {
                $table->dropUnique(['kode']);
                $table->dropColumn('kode');
            }
        });
    }
};
