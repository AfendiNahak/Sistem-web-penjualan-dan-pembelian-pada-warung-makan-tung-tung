<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanPembelianController extends Controller
{
    public function index(Request $request)
    {
        $data = '';

        if ($request->data == 'all') {
            $data = Pembelian::orderBy('id', 'asc')
                ->latest()
                ->get();
        } elseif ($request->data == 'today') {
            $data = Pembelian::orderBy('id', 'asc')
                ->whereDate('created_at', Carbon::now())
                ->latest()
                ->get();
        } elseif ($request->data == 'thisMonth') {
            $data = Pembelian::orderBy('id', 'asc')
                ->whereMonth('created_at', Carbon::now()->month)
                ->latest()
                ->get();
        } else {
            if ($request->month) {
                $data = Pembelian::orderBy('id', 'asc')
                    ->whereMonth('created_at', $request->month)
                    ->latest()
                    ->get();
            } elseif ($request->year) {
                $data = Pembelian::orderBy('id', 'asc')
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            } else {
                $data = Pembelian::orderBy('id', 'asc')
                    ->whereMonth('created_at', $request->month)
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            }
        }

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('halaman.pembelian.laporan', ['data' => $data, 'today' => $today]);
    }
}
