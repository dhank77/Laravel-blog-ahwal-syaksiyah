<?php

namespace App\Http\Controllers;

use App\Models\Short;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ShortController extends Controller
{
    public function index()
    {
        return view('short.index');
    }

    function json()
    {
        $data = Short::latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('slug', function ($data) {
                $link = url('/link' . '/' . $data->slug);
                $button = '<a target="_blank" href='. $link . '>'. $link .'</a>';
                return $button;
            })
            ->editColumn('url_tujuan', function ($data) {
                $link = $data->url_tujuan;
                $button = '<a target="_blank" href='. $link . '>'. $link .'</a>';
                return $button;
            })
            ->addColumn('action', function ($data) {
                $button = '<a href='. route("short.edit", $data->id) . ' class="btn btn-primary btn-sm">Edit</a>';
                $button .= '<a href='. route("short.delete", $data->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                return $button;
            })
            ->rawColumns(['action', 'slug', 'url_tujuan'])
            ->make(true);
    }

    public function add()
    {
        $short  = new Short();
        return view('short.add', compact('short'));
    }

    public function edit(Short $short)
    {
        return view('short.add', compact('short'));
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'slug' => 'required',
            'url_tujuan' => 'required',
        ];
        
        $id = request('id');
        $data = request()->validate($rules);

        $cr = Short::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("short.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("short.index"))->with('error', 'Gagal memperbaharui data');
        }
    }

    public function delete(Short $short)
    {
        $cr = $short->delete();
        if($cr){
            return redirect(route("short.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("short.index"))->with('error', 'Gagal menghapus data');
        }
    }
}
