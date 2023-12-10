<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Menu $menu)
    {
        return view('halaman.menu.index', [
            'makanans' => $menu->where('kategori', 'makanan')->latest()->get(),
            'minumans' => $menu->where('kategori', 'minuman')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.menu.create');
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
            'nama'      => 'required|min:3',
            'harga'     => 'required|regex:/([0-9]+[.,]*)+/',
            'kategori'  => 'required',
            'deskripsi' => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048'
            // 'image'     => 'required|image|file|max:3048'
        ]);

        // if ($image = $request->file('image')) {
        //     $destinationPath = 'images/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $validateddata['foto'] = "$profileImage";
        // }
        $validateddata["foto"] = $request->file('image')->store('menu');
        $validateddata["harga"] = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);

        Menu::create($validateddata);

        return redirect('/menu')->with('success', 'Menu baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Menu $menu)
    {
        $id = $request->id;
        $menu = $menu->find($id);
        $menu->diff = $menu->created_at->diffForHumans();;
        return $menu;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('halaman.menu.edit', [
            'menu_edit' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validateddata = $request->validate([
            'nama'      => 'required|min:3',
            'harga'     => 'required|regex:/([0-9]+[.,]*)+/',
            'kategori'  => 'required',
            'deskripsi' => 'required',
        ]);

        if ($request->file('picture')) {
            Storage::delete($menu->foto);
            $validateddata['foto'] = $request->file('picture')->store('menu');
        }

        $validateddata["harga"] = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);

        Menu::where('id', $menu->id)
            ->update($validateddata);

        return redirect('/menu')->with('success', 'Menu berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Storage::delete($menu->foto);
        $menu->destroy($menu->id);

        return redirect('/menu')->with('success', 'Menu berhasil dihapus!');
    }
}
