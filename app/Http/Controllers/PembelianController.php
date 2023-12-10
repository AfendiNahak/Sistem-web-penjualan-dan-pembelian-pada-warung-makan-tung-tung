<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Pembelian::orderBy('id', 'asc')
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $today = Pembelian::orderBy('id', 'asc')
            ->whereDate('created_at', Carbon::now())
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $thisMonth = Pembelian::orderBy('id', 'asc')
            ->whereMonth('created_at', Carbon::now()->month)
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);

        return view('halaman.pembelian.index', [
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
    public function create()
    {
        $suppliers = Supplier::orderBy('created_at', 'asc')->get();
        return view('halaman.pembelian.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'  => 'required',
            'nama_brg'     => 'required',
            'tgl_beli'     => 'required',
            'tgl_produksi' => 'required',
            'exp'          => 'required',
            'jumlah'       => 'required',
            'satuan'       => 'required|regex:/([0-9]+[.,]*)+/',
            'biaya_agkt'   => 'required|regex:/([0-9]+[.,]*)+/',
            'total'        => 'required|regex:/([0-9]+[.,]*)+/'
        ]);

        $validateddata["jumlah"] = filter_var($request->jumlah, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["satuan"] = filter_var($request->satuan, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["biaya_agkt"] = filter_var($request->biaya_agkt, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["total"] = filter_var($request->total, FILTER_SANITIZE_NUMBER_INT);
        $kodeBeli = "PBL-" . $this->generateUniqueCode();

        Pembelian::create([
            'supplier_id'  => $request->supplier_id,
            'kode'         => $kodeBeli,
            'nama_brg'     => $request->nama_brg,
            'jumlah'       => $validateddata["jumlah"],
            'satuan'       => $validateddata["satuan"],
            'tgl_beli'     => $request->tgl_beli,
            'tgl_produksi' => $request->tgl_produksi,
            'exp'          => $request->exp,
            'biaya_agkt'   => $validateddata["biaya_agkt"],
            'total'        => $validateddata["total"]
        ]);

        return redirect('/pembelian')->with(
            'success',
            'Data pembelian berhasil dibuat!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembelianModel  $pembelianModel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pembelian $pembelian)
    {
        $id = $request->id;
        $pembelian = $pembelian->find($id);
        return $pembelian;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembelianModel  $pembelianModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        return view('halaman.pembelian.edit', [
            'edit_pembelian' => $pembelian,
            'suppliers' => Supplier::orderBy('created_at', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembelianModel  $pembelianModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateddata = $request->validate([
            'supplier_id'  => 'required',
            'nama_brg'     => 'required',
            'tgl_beli'     => 'required',
            'tgl_produksi' => 'required',
            'exp'          => 'required',
            'jumlah'       => 'required',
            'satuan'       => 'required|regex:/([0-9]+[.,]*)+/',
            'biaya_agkt'   => 'required|regex:/([0-9]+[.,]*)+/',
            'total'        => 'required|regex:/([0-9]+[.,]*)+/'
        ]);

        $validateddata["jumlah"] = filter_var($request->jumlah, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["satuan"] = filter_var($request->satuan, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["biaya_agkt"] = filter_var($request->biaya_agkt, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["total"] = filter_var($request->total, FILTER_SANITIZE_NUMBER_INT);

        $update = [
            'supplier_id'  => $request->supplier_id,
            'nama_brg'     => $request->nama_brg,
            'jumlah'       => $validateddata["jumlah"],
            'satuan'       => $validateddata["satuan"],
            'tgl_beli'     => $request->tgl_beli,
            'tgl_produksi' => $request->tgl_produksi,
            'exp'          => $request->exp,
            'biaya_agkt'   => $validateddata["biaya_agkt"],
            'total'        => $validateddata["total"],
            'updated_at'   => date('Y-m-d H:i:s')
        ];

        Pembelian::where('id', $id)->update($update);

        return redirect('/pembelian')->with('success', 'Data pembelian berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembelianModel  $pembelianModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        $pembelian->destroy($pembelian->id);

        return redirect('/pembelian')->with('success', 'Data pembelian berhasil dihapus!');
    }

    public function generateUniqueCode()
    {
        do {
            $kode = random_int(1000000000, 9999999999);
        } while (Pembelian::where("kode", "=", $kode)->first());

        return $kode;
    }
}
