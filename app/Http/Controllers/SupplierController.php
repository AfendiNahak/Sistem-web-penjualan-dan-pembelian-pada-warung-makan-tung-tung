<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'asc')->get();
        return view('halaman.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.supplier.create');
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
            'nama'    => 'required',
            'email'   => 'required',
            'alamat'  => 'required',
            'kota'    => 'required',
            'no_telp' => 'required'
        ]);

        Supplier::create($validateddata);

        return redirect('/supplier')->with('success', 'Data Supplier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierModel  $supplierModel
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, Supplier $supplier)
    {
        $id = $request->id;
        $supplier = $supplier->find($id);
        return $supplier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierModel  $supplierModel
     * @return \Illuminate\Http\Response
     */

    public function edit(Supplier $supplier)
    {
        return view('halaman.supplier.edit', [
            'supplier_edit' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierModel  $supplierModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validateddata = $request->validate([
            'nama'    => 'required',
            'email'   => 'required',
            'alamat'  => 'required',
            'kota'    => 'required',
            'no_telp' => 'required'
        ]);

        Supplier::where('id', $supplier->id)
            ->update($validateddata);

        return redirect('/supplier')->with('success', 'Data supplier berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierModel  $supplierModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->destroy($supplier->id);

        return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus!');
    }
}
