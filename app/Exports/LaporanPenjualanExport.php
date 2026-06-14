<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanPenjualanExport implements FromCollection
{
    public function collection()
    {
        return Pesanan::where(
            'status_pembayaran',
            'sudah_bayar'
        )->get();
    }
}