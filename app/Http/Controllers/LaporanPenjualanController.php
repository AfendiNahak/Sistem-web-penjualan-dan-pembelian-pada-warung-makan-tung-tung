<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $data = '';

        if ($request->data == 'all') {
            $data = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                ->latest()
                ->get();
        } elseif ($request->data == 'today') {
            $data = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                ->whereDate('created_at', Carbon::now())
                ->latest()
                ->get();
        } elseif ($request->data == 'thisMonth') {
            $data = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                ->whereMonth('created_at', Carbon::now()->month)
                ->latest()
                ->get();
        } else {
            if ($request->month) {
                $data = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                    ->whereMonth('created_at', $request->month)
                    ->latest()
                    ->get();
            } elseif ($request->year) {
                $data = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            } else {
                $data = Penjualan::with(['transaction_details', 'transaction_details.menu'])
                    ->whereMonth('created_at', $request->month)
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            }
        }

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('halaman.penjualan.laporan', ['data' => $data, 'today' => $today]);
    }
}
