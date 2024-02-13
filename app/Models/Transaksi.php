<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'account_id',
        'school_id',
        'study_group_id',
        'class_id',
        'student_id',
        'transaction_order',
        'transaction_type',
        'transaction_date',
        'transaction_month',
        'transaction_year',
        'transaction_fee',
        'transaction_total',
        'transaction_via',
        'transfer_evidence',
        'information'
    ];
}
