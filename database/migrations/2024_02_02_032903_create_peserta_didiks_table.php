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
        Schema::create('peserta_didiks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('account_id');
            $table->string('profil_siswa')->nullable();
            
            $table->string('name');
            $table->string('gender');
            $table->string('nik')->nullable();
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('kind_of_stay')->nullable();
            $table->string('transportation')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('handphone_number')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('special_needs')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('fathers_date_of_birth')->nullable();
            $table->string('fathers_edu_level')->nullable();
            $table->string('fathers_occupation')->nullable();
            $table->string('fathers_income')->nullable();
            $table->string('fathers_identification_number')->nullable();
            $table->string('fathers_special_needs')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('mothers_date_of_birth')->nullable();
            $table->string('mothers_edu_level')->nullable();
            $table->string('mothers_occupation')->nullable();
            $table->string('mothers_income')->nullable();
            $table->string('mothers_identification_number')->nullable();
            $table->string('mothers_special_needs')->nullable();
            $table->string('kip_recipient')->nullable();
            $table->string('kip_number')->nullable();
            $table->string('kip_name')->nullable();
            $table->string('kks_number')->nullable();
            $table->string('birth_certificate_number')->nullable();
            $table->string('pip_eligible')->nullable();
            $table->string('pip_reasons')->nullable();
            $table->string('pip_special_needs')->nullable();
            $table->string('order_of_birth')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('number_of_siblings')->nullable();
            $table->string('distance_from_home')->nullable();
            $table->string('information');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didiks');
    }
};
