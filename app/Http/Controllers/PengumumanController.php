<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function add()
    {
        $pengumuman  = new Pengumuman();
        return view('pengumuman.add', compact('pengumuman'));
    }
    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.add', compact('pengumuman'));
    }

    public function delete(Pengumuman $pengumuman)
    {
        $cr = $pengumuman->delete();
        if($cr){
            return redirect(route("pengumuman.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("pengumuman.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'judul' => 'required|string',
            'isi' => 'required',
            'gambar' => 'max:2048|mimes:png,jpg,jpeg',
        ];
        
        $id = request('id');
        if(!$id){
            $slug = "pengumuman/" . Str::slug(request('judul'));
            $rules['gambar'] = "required|max:2048|mimes:png,jpg,jpeg";
        }else{
            $slug = Pengumuman::where('id', $id)->value('slug');
        }
        $data = request()->validate($rules);
        $data["slug"] = $slug;

        if(request()->file('gambar')){
            if($id){
                $img = Pengumuman::where('id', $id)->value('gambar');
                Storage::delete($img);
            }

            $data['gambar'] = request()->file('gambar')->storeAs("uploads/pengumuman", $slug . "." . request()->file('gambar')->extension());
        }

        $cr = Pengumuman::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("pengumuman.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("pengumuman.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
