<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::latest()->get();
        return view('testimoni.index', compact('testimoni'));
    }

    public function add()
    {
        $testimoni  = new Testimoni();
        return view('testimoni.add', compact('testimoni'));
    }
    public function edit(Testimoni $testimoni)
    {
        return view('testimoni.add', compact('testimoni'));
    }

    public function delete(Testimoni $testimoni)
    {
        $cr = $testimoni->delete();
        if($cr){
            return redirect(route("setting.testimoni.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("setting.testimoni.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'isi' => 'required|string',
            'jabatan' => 'required|string',
            'gambar' => 'max:2048|mimes:png,jpg,jpeg',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['gambar'] = "required|max:2048|mimes:png,jpg,jpeg";
        }
        $data = request()->validate($rules);

        if(request()->file('gambar')){
            if($id){
                $img = Testimoni::where('id', $id)->value('gambar');
                Storage::delete($img);
            }

            $data['gambar'] = request()->file('gambar')->storeAs("uploads/testimoni", date("ymdhis") . "." . request()->file('gambar')->extension());
        }

        $cr = Testimoni::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("setting.testimoni.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("setting.testimoni.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
