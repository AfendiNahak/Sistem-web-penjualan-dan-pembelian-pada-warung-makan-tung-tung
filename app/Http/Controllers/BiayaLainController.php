<?php

namespace App\Http\Controllers;

use App\Models\BiayaLain;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BiayaLainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = BiayaLain::orderBy('id', 'asc')
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $today = BiayaLain::orderBy('id', 'asc')
            ->whereDate('created_at', Carbon::now())
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);
        $thisMonth = BiayaLain::orderBy('id', 'asc')
            ->whereMonth('created_at', Carbon::now()->month)
            ->latest()
            ->filter(request(['year', 'month']))
            ->paginate(5);

        return view('halaman.biaya_lain.index', [
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
        return view('halaman.biaya_lain.create');
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
            'tgl_transaksi' => 'required',
            'nama'          => 'required',
            'harga'         => 'required|regex:/([0-9]+[.,]*)+/',
            'jumlah'        => 'required',
            'total'         => 'required|regex:/([0-9]+[.,]*)+/'
        ]);

        $validateddata["harga"] = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["jumlah"] = filter_var($request->jumlah, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["total"] = filter_var($request->total, FILTER_SANITIZE_NUMBER_INT);
        $code = "BL-" . $this->generateUniqueCode();

        BiayaLain::create([
            'kode_biayalain' => $code,
            'tgl_transaksi'  => $request->tgl_transaksi,
            'nama'           => $request->nama,
            'harga'          => $validateddata["harga"],
            'jumlah'         => $validateddata["jumlah"],
            'total'          => $validateddata["total"]
        ]);

        return redirect('/biaya-lain')->with('success', 'Data biaya lainnya berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BiayaLain $biayalain)
    {
        $id = $request->id;
        $biayalain = $biayalain->find($id);
        return $biayalain;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $edit_biayalain = BiayaLain::findOrFail($id);
        return view('halaman.biaya_lain.edit', compact('edit_biayalain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
            'nama'          => 'required',
            'harga'         => 'required|regex:/([0-9]+[.,]*)+/',
            'jumlah'        => 'required',
            'total'         => 'required|regex:/([0-9]+[.,]*)+/'
        ]);

        $validateddata["harga"] = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["jumlah"] = filter_var($request->jumlah, FILTER_SANITIZE_NUMBER_INT);
        $validateddata["total"] = filter_var($request->total, FILTER_SANITIZE_NUMBER_INT);

        $update = [
            'tgl_transaksi' => $request->tgl_transaksi,
            'nama'          => $request->nama,
            'harga'         => $validateddata["harga"],
            'jumlah'        => $validateddata["jumlah"],
            'total'         => $validateddata["total"],
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        BiayaLain::where('id', $id)->update($update);

        return redirect('/biaya-lain')->with('success', 'Data biaya lainnya berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biayaLainHapus = BiayaLain::findOrFail($id);
        $biayaLainHapus->delete();
        return redirect()->route('biaya-lain.index')
            ->with('success', 'Data biaya lainnya berhasil dihapus!');
    }

    public function generateUniqueCode()
    {
        do {
            $kode = random_int(1000000000, 9999999999);
        } while (BiayaLain::where("kode_biayalain", "=", $kode)->first());

        return $kode;
    }
}
