<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // The estimate/quote built from the lead card: items, discount, notes, valid-until date and total
    public function up(): void
    {
        if (Schema::hasColumn('leads', 'estimate')) {
            return;
        }

        Schema::table('leads', function (Blueprint $table) {
            $table->json('estimate')->nullable();
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('leads', 'estimate')) {
            return;
        }

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('estimate');
        });
    }
};
