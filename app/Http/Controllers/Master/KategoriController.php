<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use Illuminate\Support\Str;


class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return view('kategori.index', compact('kategori'));
    }

    public function add()
    {
        $kategori  = new Kategori();
        return view('kategori.add', compact('kategori'));
    }
    public function edit(Kategori $kategori)
    {
        return view('kategori.add', compact('kategori'));
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

        $cr = Kategori::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("artikel.kategori.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("artikel.kategori.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
