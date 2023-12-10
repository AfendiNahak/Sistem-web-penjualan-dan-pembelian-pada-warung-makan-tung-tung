<?php

namespace App\Http\Controllers;

use App\Models\BiayaLain;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Support\Carbon;

class LabaRugiController extends Controller
{
    public function index()
    {
        $semuaPenjualan = Penjualan::with(['transaction_details', 'transaction_details.menu'])
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $penjualanPerBulan = Penjualan::with(['transaction_details', 'transaction_details.menu'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $semuaPembelian = Pembelian::orderBy('id', 'asc')
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $pembelianPerBulan = Pembelian::orderBy('id', 'asc')
            ->whereMonth('created_at', Carbon::now()->month)
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $semuaBiayaLain = BiayaLain::orderBy('id', 'asc')
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $biayaLainPerBulan = BiayaLain::orderBy('id', 'asc')
            ->whereMonth('created_at', Carbon::now()->month)
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);

        return view('halaman.laba_rugi.index', [
            'semuaPenjualan' => $semuaPenjualan,
            'penjualanPerBulan' => $penjualanPerBulan,
            'semuaPembelian' => $semuaPembelian,
            'pembelianPerBulan' => $pembelianPerBulan,
            'semuaBiayaLain' => $semuaBiayaLain,
            'biayaLainPerBulan' => $biayaLainPerBulan
        ]);
    }
}
