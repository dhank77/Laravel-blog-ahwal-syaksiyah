<?php

namespace App\Http\Controllers;

use App\Imports\AlumniImport;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AlumniController extends Controller
{
    public function index()
    {
        return view('alumni.index');
    }

    function json()
    {
        $data = Alumni::latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('ttl', function ($data) {
                return "$data->tempat_lahir, " . tanggal_indo($data->tanggal_lahir);
            })
            ->addColumn('kontak', function ($data) {
                return "$data->email, $data->no_hp";
            })
            ->addColumn('action', function ($data) {
                $button = '<a href='. route("alumni.edit", $data->id) . ' class="btn btn-primary btn-sm">Edit</a>';
                $button .= '<a href='. route("alumni.delete", $data->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function add()
    {
        $alumni  = new Alumni();
        return view('alumni.add', compact('alumni'));
    }

    public function edit(Alumni $alumni)
    {
        return view('alumni.add', compact('alumni'));
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'nim' => 'required|string',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'angkatan' => 'nullable',
            'tahun_lulus' => 'nullable',
            'asal_daerah' => 'nullable',
            'alamat' => 'nullable',
            'pekerjaan' => 'nullable',
            'email' => 'nullable',
            'no_hp' => 'nullable',
        ];
        
        $id = request('id');
        $data = request()->validate($rules);

        $cr = Alumni::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("alumni.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("alumni.index"))->with('error', 'Gagal memperbaharui data');
        }
    }

    public function delete(Alumni $alumni)
    {
        $cr = $alumni->delete();
        if($cr){
            return redirect(route("alumni.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("alumni.index"))->with('error', 'Gagal menghapus data');
        }
    }

    function import()
    {
        $rules = [
            'file' => 'max:2048|max:2048|mimes:xls,xlsx,csv',
        ];

        request()->validate($rules);

        $file = request()->file('file');

        try {
            Excel::import(new AlumniImport, $file);
            return redirect(route('alumni.index'))->with('success', 'Berhasil import data');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect(route('alumni.index'))->with('error', 'Terjadi Kesalahan');
        }

    }
}
