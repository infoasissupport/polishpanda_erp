<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Company seal image (uploaded in Settings like the signature), printed beside the signature
    public function up(): void
    {
        if (Schema::hasColumn('company_settings', 'seal')) {
            return;
        }

        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('seal')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('company_settings', 'seal')) {
            return;
        }

        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn('seal');
        });
    }
};
