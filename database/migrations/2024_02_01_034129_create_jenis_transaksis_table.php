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
        Schema::create('jenis_transaksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('account_id');
            $table->string('study_group_id');
            $table->string('transaction_type');
            $table->string('transaction_fees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_transaksis');
    }
};
