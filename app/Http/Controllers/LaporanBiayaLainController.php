<?php

namespace App\Http\Controllers;

use App\Models\BiayaLain;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanBiayaLainController extends Controller
{
    public function index(Request $request)
    {
        $data = '';

        if ($request->data == 'all') {
            $data = BiayaLain::orderBy('id', 'asc')
                ->latest()
                ->get();
        } elseif ($request->data == 'today') {
            $data = BiayaLain::orderBy('id', 'asc')
                ->whereDate('created_at', Carbon::now())
                ->latest()
                ->get();
        } elseif ($request->data == 'thisMonth') {
            $data = BiayaLain::orderBy('id', 'asc')
                ->whereMonth('created_at', Carbon::now()->month)
                ->latest()
                ->get();
        } else {
            if ($request->month) {
                $data = BiayaLain::orderBy('id', 'asc')
                    ->whereMonth('created_at', $request->month)
                    ->latest()
                    ->get();
            } elseif ($request->year) {
                $data = BiayaLain::orderBy('id', 'asc')
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            } else {
                $data = BiayaLain::orderBy('id', 'asc')
                    ->whereMonth('created_at', $request->month)
                    ->whereYear('created_at', $request->year)
                    ->latest()
                    ->get();
            }
        }

        $today = Carbon::now()->isoFormat('D MMMM Y');

        return view('halaman.biaya_lain.laporan', ['data' => $data, 'today' => $today]);
    }
}
