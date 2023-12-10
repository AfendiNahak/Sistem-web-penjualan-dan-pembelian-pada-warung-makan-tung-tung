<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaman.pelanggan.index', [
            'pelanggans' => Pelanggan::orderBy('created_at', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.pelanggan.create', [
            'penjualans' => Penjualan::orderBy('created_at', 'asc')->get()
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
        $validateddata = $request->validate([
            'kode_penjualan'    => 'required',
            'nama'    => 'required',
            'email'   => 'required',
            'no_telp' => 'required',
            'kota'    => 'required',
            'alamat'  => 'required'
        ]);

        Pelanggan::create($validateddata);

        return redirect('/pelanggan')->with('success', 'Data Pelanggan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pelanggan $pelanggan)
    {
        $id = $request->id;
        $pelanggan = $pelanggan->find($id);
        return $pelanggan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('halaman.pelanggan.edit', [
            'pelanggan_edit' => $pelanggan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validateddata = $request->validate([
            'nama'    => 'required',
            'email'   => 'required',
            'alamat'  => 'required',
            'kota'    => 'required',
            'no_telp' => 'required'
        ]);

        Pelanggan::where('id', $pelanggan->id)
            ->update($validateddata);

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->destroy($pelanggan->id);

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil dihapus!');
    }
}
