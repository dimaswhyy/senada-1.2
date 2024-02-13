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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('account_id');
            $table->string('school_id');
            $table->string('study_group_id');
            $table->string('class_id');
            $table->string('student_id');
            $table->string('transaction_order');
            $table->string('transaction_type');
            $table->date('transaction_date');
            $table->string('transaction_month');
            $table->string('transaction_year');
            $table->string('transaction_fee');
            $table->string('transaction_total');
            $table->string('transaction_via');
            $table->longText('transfer_evidence');
            $table->string('information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
