<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Master\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        if(roles() == 'publisher'){
            $kategori_id = auth()->user()->kategori_id;
            $artikel = Artikel::latest()->whereRaw("kategori_id IN ($kategori_id)")->get();
        }else{
            $artikel = Artikel::latest()->get();
        }
        return view('artikel.index', compact('artikel'));
    }

    public function add()
    {
        $artikel  = new Artikel();
        if(roles() == 'publisher'){
            $kategori_id = auth()->user()->kategori_id;
            $kategori = Kategori::orderBy('nama')->whereRaw("id IN ($kategori_id)")->get();
        }else{
            $kategori = Kategori::orderBy('nama')->get();
        }
        return view('artikel.add', compact('artikel', 'kategori'));
    }
    public function edit(Artikel $artikel)
    {
        if(roles() == 'publisher'){
            $kategori_id = auth()->user()->kategori_id;
            $kategori = Kategori::orderBy('nama')->whereRaw("id IN ($kategori_id)")->get();
        }else{
            $kategori = Kategori::orderBy('nama')->get();
        }
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
        $rules = [
            'judul' => 'required|string',
            'kategori_id' => 'required',
            'isi' => 'required',
            'status' => 'required',
            'gambar' => 'max:2048|mimes:png,jpg,jpeg',
        ];
        
        $id = request('id');
        if(!$id){
            $slug = "artikel/" . Str::slug(request('judul'));
            $rules['gambar'] = "required|max:2048|mimes:png,jpg,jpeg";
        }else{
            $slug = Artikel::where('id', $id)->value('slug');
        }
        $data = request()->validate($rules);
        $data["slug"] = $slug;

        if(request()->file('gambar')){
            if($id){
                $img = Artikel::where('id', $id)->value('gambar');
                Storage::delete($img);
            }

            $data['gambar'] = request()->file('gambar')->storeAs("uploads/artikel", $slug . "." . request()->file('gambar')->extension());
        }

        $cr = Artikel::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("artikel.artikel.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("artikel.artikel.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
