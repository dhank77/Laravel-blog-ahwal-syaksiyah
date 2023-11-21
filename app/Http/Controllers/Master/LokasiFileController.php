<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Master\LokasiFile;
use Illuminate\Support\Str;

class LokasiFileController extends Controller
{
    public function index()
    {
        $lokasiFile = LokasiFile::latest()->get();
        return view('lokasiFile.index', compact('lokasiFile'));
    }

    public function lihat(LokasiFile $lokasiFile)
    {
        $file = Download::where('lokasi_id', $lokasiFile->id)->latest()->get();
        return view('lokasiFile.lihat', compact('file', 'lokasiFile'));
    }

    public function add()
    {
        $lokasiFile  = new LokasiFile();
        return view('lokasiFile.add', compact('lokasiFile'));
    }
    public function edit(LokasiFile $lokasiFile)
    {
        return view('lokasiFile.add', compact('lokasiFile'));
    }

    public function delete(LokasiFile $lokasiFile)
    {
        $cr = $lokasiFile->delete();
        if($cr){
            return redirect(route("lokasiFile.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("lokasiFile.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $data = request()->validate([
            'nama' => 'required|string'
        ]);

        $id = request('id');
        if(!$id){
            $data["slug"] = Str::slug($data['nama']) ."-". generateRandomString(3);
        }

        $cr = LokasiFile::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("lokasiFile.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("lokasiFile.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
