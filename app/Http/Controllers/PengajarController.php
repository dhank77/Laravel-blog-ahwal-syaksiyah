<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Support\Facades\Storage;

class PengajarController extends Controller
{
    public function index()
    {
        $pengajar = Pengajar::latest()->get();
        return view('pengajar.index', compact('pengajar'));
    }

    public function add()
    {
        $pengajar  = new Pengajar();
        return view('pengajar.add', compact('pengajar'));
    }
    public function edit(Pengajar $pengajar)
    {
        return view('pengajar.add', compact('pengajar'));
    }

    public function delete(Pengajar $pengajar)
    {
        $cr = $pengajar->delete();
        if($cr){
            return redirect(route("pengajar.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("pengajar.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'keahlian' => 'required',
            'gambar' => 'max:2048',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['gambar'] = "required|max:2048";
        }
        $data = request()->validate($rules);

        if(request()->file('gambar')){
            if($id){
                $img = Pengajar::where('id', $id)->value('gambar');
                Storage::delete($img);
            }

            $data['gambar'] = request()->file('gambar')->storeAs("uploads/pengajar",date("ymdhis") . "." . request()->file('gambar')->extension());
        }

        $cr = Pengajar::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("pengajar.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("pengajar.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
