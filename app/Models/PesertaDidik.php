<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PesertaDidik extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;
    // protected $table = 'account_admin_gudeps';
    protected $primaryKey="id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'account_id',
        'photo_profile',

        'name', //nama
        'gender', //jenis kelamin
        'nik', //nik
        'nis', //nis
        'nisn', //nisn
        'place_of_birth', //tempat lahir
        'date_of_birth', //tanggal lahir
        'religion', //agama
        'citizenship', //kewarganegaraan
        'address', //alamat
        'rt', //rt
        'rw', //rw
        'sub_district', //kelurahan
        'district', //kecamatan
        'city', //kota/kabupaten
        'postal_code', //kode pos
        'kind_of_stay', //jenis tinggal
        'transportation', //moda transportasi
        'telephone_number', //telepon rumah
        'handphone_number', //telepon HP
        'previous_school', //asal sekolah
        'special_needs', //berkebutuhan khusus
        'fathers_name', //nama ayah
        'fathers_date_of_birth', //tanggal lahir ayah
        'fathers_edu_level', //jenjang pendidikan ayah
        'fathers_occupation', //pekerjaan ayah
        'fathers_income', //penghasilan ayah
        'fathers_identification_number', //nik ayah
        'fathers_special_needs', //berkebutuhan khusus ayah
        'mothers_name', //nama ibu
        'mothers_date_of_birth', //tanggal lahir ibu
        'mothers_edu_level', //jenjang pendidikan ibu
        'mothers_occupation', //pekerjaan ibu
        'mothers_income', //penghasilan ibu
        'mothers_identification_number', //nik ibu
        'mothers_special_needs', //berkebutuhan khusus ibu
        'kip_recipient', //penerima kip
        'kip_number', //nomor kip
        'kip_name', //nama kip
        'kks_number', //nomor kks
        'birth_certificate_number', //nomor akta lahir
        'pip_eligible', //layak pip
        'pip_reasons', //alasan pip
        'pip_special_needs', //berkebutuhan khusus pip
        'order_of_birth', //anak ke
        'latitude', //lintang
        'longitude', //bujur
        'weight', //berat badan
        'height', //tinggi badan
        'number_of_siblings', //jumlah saudara
        'distance_from_home', //jarak rumah
        'information',

        'email',
        'password',
        'role_id'
    ]; 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
