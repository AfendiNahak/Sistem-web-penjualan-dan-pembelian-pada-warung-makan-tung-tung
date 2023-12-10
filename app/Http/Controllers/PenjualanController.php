<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Penjualan::with(['transaction_details', 'transaction_details.menu'])
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $today = Penjualan::with(['transaction_details', 'transaction_details.menu'])
            ->whereDate('created_at', Carbon::now())
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $thisMonth = Penjualan::with(['transaction_details', 'transaction_details.menu'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);

        return view('halaman.penjualan.index', [
            'all' => $all,
            'today' => $today,
            'thisMonth' => $thisMonth
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Menu $menu)
    {
        return view('halaman.penjualan.create', [
            'makanans' => $menu->where('kategori', 'makanan')->latest()->get(),
            'minumans' => $menu->where('kategori', 'minuman')->latest()->get(),
            'id' => Penjualan::select('id')->where('status', 'unpaid')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = $request->validate([
            'total_harga' => 'required'
        ]);

        $kodeJual = "PJL-" . $this->generateUniqueCode();

        $transaction['kode'] = $kodeJual;
        $transaction['total_bayar'] = 0;
        $transaction['status'] = 'unpaid';
        $transaction['created_at'] = Carbon::now();
        $transaction['updated_at'] = Carbon::now();

        $id = Penjualan::insertGetId($transaction);

        $transactionDetail = $request->validate([
            'menu_id' => 'required'
        ]);

        $menu_id = json_decode($request->menu_id);

        for ($i = 0; $i < count($menu_id); $i++) {
            $transactionDetail['penjualan_id'] = $id;
            $transactionDetail['menu_id'] = $menu_id[$i]->menu_id;
            $transactionDetail['jumlah'] = $menu_id[$i]->qty;
            $transactionDetail['harga'] = $menu_id[$i]->price;
            DetailTransaksi::create($transactionDetail);
        };

        return redirect('/penjualan')->with('success', 'Transaksi penjualan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenjualanModel  $penjualanModel
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        return view('halaman.penjualan.show', [
            'data' => $penjualan->with(['transaction_details', 'transaction_details.menu'])->where('id', '=', $penjualan->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenjualanModel  $penjualanModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenjualanModel  $penjualanModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $validateddata = $request->validate([
            'total_harga' => 'required|numeric',
            'total_bayar' => 'required|numeric|gte:total_harga'
        ]);

        $validateddata["total_bayar"] = filter_var($request->total_bayar, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["status"] = 'paid';

        Penjualan::where('id', $penjualan->id)
            ->update($validateddata);

        return redirect('/penjualan')->with('success', 'Transaksi penjualan selesai dibayar!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenjualanModel  $penjualanModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $child = DB::table('detail_transaksis')->where('id', $id)->get();
        if ($child->count() == 0) {
            DB::table('penjualans')->where('id', $id)->delete();;
        }
    }

    public function generateUniqueCode()
    {
        do {
            $kode = random_int(1000000000, 9999999999);
        } while (Penjualan::where("kode", "=", $kode)->first());

        return $kode;
    }
}
