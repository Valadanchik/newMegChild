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
        Schema::table('accessors', function (Blueprint $table) {
            $table->enum('discount_sum_type', ['percent', 'amount'])->default('amount')->after('code');
            $table->enum('expire_type', ['for_one_use', 'interval'])->default('interval')->after('type');
            $table->dateTime('discount_start_date')->nullable()->after('expire_type');
            $table->dateTime('discount_expire_date')->nullable()->after('discount_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accessors', function (Blueprint $table) {
            //
        });
    }
};
