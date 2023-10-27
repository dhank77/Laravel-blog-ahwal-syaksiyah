<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function index()
    {
        $download = Download::where('is_public', 0)->whereNull('pengajar_id')->latest()->get();
        return view('berkas.index', compact('download'));
    }

    public function add()
    {
        $download  = new Download();
        return view('berkas.add', compact('download'));
    }

    public function edit(Download $download)
    {
        return view('berkas.add', compact('download'));
    }

    public function delete(Download $download)
    {
        if($download->file != ""){
            Storage::delete($download->file);
        }
        $cr = $download->delete();
        if($cr){
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        }else{
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'pengajar_id' => 'nullable',
            'file' => 'max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx,ppt,pptx',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['file'] = "required|max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx,ppt,pptx";
        }
        $data = request()->validate($rules);
        $data['is_public'] = 0;

        $pengajar_id = request('pengajar_id');
        if(request()->file('file')){
            if($id){
                $img = Download::where('id', $id)->value('gambar');
                Storage::delete($img);
            }
            if($pengajar_id != ""){
                $path =  "/uploads" . "/" . $pengajar_id ;
            }else{
                $path = "uploads/berkas";
            }
            $data['file'] = request()->file('file')->storeAs($path, Str::slug(request('nama')) . "-" . date("ymdhis") . "." . request()->file('file')->extension());
        }

        $cr = Download::updateOrCreate(['id' => $id], $data);

        
        if($pengajar_id != ""){
            if($cr){
                return redirect(route("pengajar.berkas", $pengajar_id))->with('success', 'Berhasil memperbaharui data');
            }else{
                return redirect(route("pengajar.berkas", $pengajar_id))->with('error', 'Gagal memperbaharui data');
            }
        }else{
            if($cr){
                return redirect(route("berkas.index"))->with('success', 'Berhasil memperbaharui data');
            }else{
                return redirect(route("berkas.index"))->with('error', 'Gagal memperbaharui data');
            }
        }
    }
}
