<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class HalamanController extends Controller
{
    public function index()
    {
        return view('halaman.index');
    }

    function json()
    {
        $data = Halaman::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('gambar', function ($data) {
                return '<img src=' . asset("storage/$data->gambar") .' style="width:100px; height:50px;" />';
            })
            ->editColumn('tanggal', function ($data) {
                return dmyhi($data->created_at);
            })
            ->addColumn('action', function ($data) {
                $button = '<a href='. route("utama.halaman.edit", $data->id) . ' class="btn btn-primary btn-sm">Edit</a>';
                $button .= '<a href='. route("utama.halaman.delete", $data->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                return $button;
            })
            ->rawColumns(['action', 'gambar'])
            ->make(true);
    }

    public function add()
    {
        $halaman  = new Halaman();
        return view('halaman.add', compact('halaman'));
    }

    public function edit(Halaman $halaman)
    {
        return view('halaman.add', compact('halaman'));
    }

    public function delete(Halaman $halaman)
    {
        $cr = $halaman->delete();
        if($cr){
            return redirect(route("utama.halaman.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("utama.halaman.index"))->with('error', 'Gagal menghapus data');
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
            $slug = "halaman/" . Str::slug(request('judul'));
            $rules['gambar'] = "required|max:2048|mimes:png,jpg,jpeg";
        }else{
            $slug = Halaman::where('id', $id)->value('slug');
        }
        $data = request()->validate($rules);
        $data["slug"] = $slug;

        if(request()->file('gambar')){
            if($id){
                $img = Halaman::where('id', $id)->value('gambar');
                Storage::delete($img);
            }

            $data['gambar'] = request()->file('gambar')->storeAs("uploads/halaman", $slug . "." . request()->file('gambar')->extension());
        }

        $cr = Halaman::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("utama.halaman.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("utama.halaman.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
