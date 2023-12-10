<?php

namespace App\Http\Controllers;

use App\Models\BiayaLain;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanLabaRugiController extends Controller
{
    public function index(Request $request)
    {
        $dataPenjualan = '';
        $dataPembelian = '';
        $dataBiayaLain = '';

        if ($request->data == 'all') {
            $dataPenjualan = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                ->latest()
                ->get();
        } elseif ($request->data == 'thisMonth') {
            $dataPenjualan = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                ->whereMonth('created_at', Carbon::now()->month)
                ->latest()
                ->get();
        } else {
            if ($request->month) {
                $dataPenjualan = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                    ->whereMonth('created_at', $request->month)
                    ->latest()
                    ->get();
            } elseif ($request->year) {
                $dataPenjualan = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            }
        }

        if ($request->data == 'all') {
            $dataPembelian = Pembelian::orderBy('id', 'asc')
                ->latest()
                ->get();
        } elseif ($request->data == 'thisMonth') {
            $dataPembelian = Pembelian::orderBy('id', 'asc')
                ->whereMonth('created_at', Carbon::now()->month)
                ->latest()
                ->get();
        } else {
            if ($request->month) {
                $dataPembelian = Pembelian::orderBy('id', 'asc')
                    ->whereMonth('created_at', $request->month)
                    ->latest()
                    ->get();
            } elseif ($request->year) {
                $dataPembelian = Pembelian::orderBy('id', 'asc')
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            }
        }

        if ($request->data == 'all') {
            $dataBiayaLain = BiayaLain::orderBy('id', 'asc')
                ->latest()
                ->get();
        } elseif ($request->data == 'thisMonth') {
            $dataBiayaLain = BiayaLain::orderBy('id', 'asc')
                ->whereMonth('created_at', Carbon::now()->month)
                ->latest()
                ->get();
        } else {
            if ($request->month) {
                $dataBiayaLain = BiayaLain::orderBy('id', 'asc')
                    ->whereMonth('created_at', $request->month)
                    ->latest()
                    ->get();
            } elseif ($request->year) {
                $dataBiayaLain = BiayaLain::orderBy('id', 'asc')
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            }
        }

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('halaman.laba_rugi.laporan', [
            'dataPenjualan' => $dataPenjualan,
            'dataPembelian' => $dataPembelian,
            'dataBiayaLain' => $dataBiayaLain,
            'today' => $today
        ]);
    }
}
