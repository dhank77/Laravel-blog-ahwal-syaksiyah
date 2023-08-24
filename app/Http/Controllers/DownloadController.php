<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $download = Download::where('is_public', 1)->latest()->get();
        return view('download.index', compact('download'));
    }

    public function add()
    {
        $download  = new Download();
        return view('download.add', compact('download'));
    }

    public function edit(Download $download)
    {
        return view('download.add', compact('download'));
    }

    public function delete(Download $download)
    {
        $cr = $download->delete();
        if($cr){
            return redirect(route("download.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("download.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'file' => 'max:2048|max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['file'] = "required|max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx";
        }
        $data = request()->validate($rules);
        $data['is_public'] = 1;

        if(request()->file('file')){
            if($id){
                $img = Download::where('id', $id)->value('gambar');
                Storage::delete($img);
            }

            $data['file'] = request()->file('file')->storeAs("uploads/download", Str::slug(request('nama')) . "-" . date("ymdhis") . "." . request()->file('file')->extension());
        }

        $cr = Download::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("download.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("download.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
