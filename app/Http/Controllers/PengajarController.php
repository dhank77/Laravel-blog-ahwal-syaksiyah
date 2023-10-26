<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Pengajar;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\File;

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

    public function berkas(Pengajar $pengajar)
    {
        $berkas = Download::where('pengajar_id', $pengajar->id)->orderBy('nama')->get();
        return view('pengajar.berkas', compact('berkas', 'pengajar'));
    }

    public function download(Pengajar $pengajar)
    {
        $id = $pengajar->id;
        $zip = new ZipArchive;

        if (true === ($zip->open("$id.zip", ZipArchive::CREATE | ZipArchive::OVERWRITE))) {
            $path = storage_path("app/public/uploads/$id");
            $files = File::allFiles($path);
            
            foreach ($files as $file) {
                $name = basename($file);
                if ($name !== '.gitignore') {
                    $zip->addFile(storage_path("app/public/uploads/$id/$name"), $name);
                }
            }
            $zip->close();
        }
    
        return response()->download(public_path("$id.zip"), "$id.zip");
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
            'pddikti' => 'nullable',
            'sinta' => 'nullable',
            'scholar' => 'nullable',
            'gambar' => 'max:2048|mimes:png,jpg,jpeg',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['gambar'] = "required|max:2048|mimes:png,jpg,jpeg";
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
