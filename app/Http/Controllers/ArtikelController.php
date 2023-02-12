<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Master\Kategori;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::latest()->get();
        return view('artikel.index', compact('artikel'));
    }

    public function add()
    {
        $artikel  = new Artikel();
        $kategori = Kategori::orderBy('nama')->get();
        return view('artikel.add', compact('artikel', 'kategori'));
    }
    public function edit(Artikel $artikel)
    {
        $kategori = Kategori::orderBy('nama')->get();
        return view('artikel.add', compact('artikel', 'kategori'));
    }

    public function delete(Artikel $artikel)
    {
        $cr = $artikel->delete();
        if($cr){
            return redirect(route("artikel.artikel.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("artikel.artikel.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $data = request()->validate([
            'nama' => 'required|string'
        ]);

        $id = request('id');
        if(!$id){
            $data["slug"] = Str::slug($data['nama']);
        }

        $cr = artikel::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("artikel.artikel.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("artikel.artikel.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
