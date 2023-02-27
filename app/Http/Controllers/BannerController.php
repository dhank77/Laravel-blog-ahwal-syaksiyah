<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::latest()->get();
        return view('banner.index', compact('banner'));
    }

    public function add()
    {
        $banner  = new Banner();
        return view('banner.add', compact('banner'));
    }
    public function edit(Banner $banner)
    {
        return view('banner.add', compact('banner'));
    }

    public function delete(banner $banner)
    {
        $cr = $banner->delete();
        if($cr){
            return redirect(route("setting.banner.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("setting.banner.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'judul' => 'nullable|string',
            'deskripsi' => 'nullable',
            'link' => 'nullable',
            'gambar' => 'max:2048|mimes:png,jpg,jpeg',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['gambar'] = "required|max:2048|mimes:png,jpg,jpeg";
        }
        $data = request()->validate($rules);

        if(request()->file('gambar')){
            if($id){
                $img = Banner::where('id', $id)->value('gambar');
                Storage::delete($img);
            }

            $data['gambar'] = request()->file('gambar')->storeAs("uploads/banner", date("ymdhis") . "." . request()->file('gambar')->extension());
        }

        $cr = Banner::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("setting.banner.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("setting.banner.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
