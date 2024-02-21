<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class PembayaranExport implements FromCollection
{
    protected $pembayarans;

    public function __construct($pembayarans)
    {
        $this->pembayarans = $pembayarans;
    }
    

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return $this->pembayarans;
    }
}
