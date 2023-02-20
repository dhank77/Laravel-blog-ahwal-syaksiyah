<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use App\Models\Master\Kategori;
use App\Models\Master\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('nama')->get();
        $halaman = Halaman::latest()->get();
        $menu_utama = Menu::whereNull('parent_id')->oldest()->get();
        return view('master.menu.index', compact('kategori', 'halaman', 'menu_utama'));
    }

    public function store()
    {
        $data = request()->validate([
            'nama' => 'required|string',
            'parent_id' => 'nullable'
        ]);

        $data['link'] = request(request('pilihan'));
        if($data['link'] == ""){
            throw ValidationException::withMessages([
                request('pilihan') => 'Isian link Wajib diisi.',
            ]);
        }

        $id = request('id');

        $cr =  Menu::updateOrCreate(["id" => $id], $data);

        if ($cr) {
            return redirect(route("utama.menu.index"))->with('success', 'Berhasil memperbaharui data');
        } else {
            return redirect(route("utama.menu.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
