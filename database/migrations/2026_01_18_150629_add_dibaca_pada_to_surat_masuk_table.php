<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->timestamp('dibaca_pada')->nullable()->after('status');
            $table->unsignedBigInteger('dibaca_oleh')->nullable()->after('dibaca_pada');
            
            // Jika ingin relasi ke user yang membaca
            $table->foreign('dibaca_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropForeign(['dibaca_oleh']);
            $table->dropColumn(['dibaca_pada', 'dibaca_oleh']);
        });
    }
};