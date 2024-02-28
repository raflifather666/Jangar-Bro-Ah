<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data menu
        // sama dengan => Select * from menu;
        $menu = Menu::all();

        // Tampilkan halaman index berita dengan rows berita 
        return view('menu.index', compact('menu'));
    }

    public function index2()
    {
        // Ambil semua data menu
        // sama dengan => Select * from menu;
        $menu = Menu::all();

        // Tampilkan halaman index berita dengan rows berita 
        return view('index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi, 4 field ini diperlukan
        // Jika ada yang kurang, di redirect ke halaman sebelumnya dengan error
        $validated = $request->validate([
            'menu' => ['required'],
            'harga' => ['required'],
            'deskripsi' => ['required'],
            'image' => ['required'],
        ]);

        // Acak nama gambar
        // Alasan acak nama gambar agar tidak ada 2 gambar dengan nama yang sama
        $imageName = $request->file('image')->hashName();

        // Taruh nama gambar baru ke array validated untuk nanti disimpan ke database
        $validated['image'] = $imageName;
        
        // Simpan gambar di folder public/menu dengan nama yang diacak tadi
        $menuDirectory = public_path() . '/menu-images';
        $request->file('image')->move($menuDirectory, $imageName);
        
        // insert row baru di table menu dengan data didalam validated
        Menu::create($validated);

        // Redirect ke halaman index
        return redirect()->route('menu.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(string $id)
    {
         // Search menu dengan id yang sedang diedit
         $menu = Menu::find($id);

         // Ke halaman edit dengan data menu yang sedang diedit
         return view('menu.edit', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Search menu dengan id yang sedang diedit
        $menu = Menu::find($id);

        // Ke halaman edit dengan data menu yang sedang diedit
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
        ]);

        $menu->update([
            'menu' => $request->get('menu'),
            'deskripsi' => $request->get('deskripsi'),
            'harga' => $request->get('harga'),
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image) {
                Storage::delete('public/menu-images' . $menu->image);
            }

            // Simpan gambar yang baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->file('image')->storeAs('public/menu-images', $imageName);
            $menu->image = 'menu-images' . $imageName;
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Search menu dengan id bersangkutan
        $menu = Menu::find($id);

        // Hapus gambar lama
        File::delete(public_path() . "/menu-images/$menu->image");

        // Hapus row dari table menu
        $menu->delete();

        // Redirect ke halaman index
        return redirect()->route('menu.index')->with('success', 'Data berhasil dihapus.');        
    }
}
