<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('pengumuman.index');
    }

    function json()
    {
        $data = Pengumuman::latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('gambar', function ($data) {
                return '<img src=' . asset("storage/$data->gambar") .' style="width:100px; height:50px;" />';
            })
            ->editColumn('tanggal', function ($data) {
                return dmyhi($data->created_at);
            })
            ->addColumn('action', function ($data) {
                $button = '<a href='. route("pengumuman.edit", $data->id) . ' class="btn btn-primary btn-sm">Edit</a>';
                $button .= '<a href='. route("pengumuman.delete", $data->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                return $button;
            })
            ->rawColumns(['action', 'gambar'])
            ->make(true);
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
            $rules['gambar'] = "required|max:2048|mimes:png,jpg,jpeg,webp";
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
