<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KomplainController extends Controller
{
    public function index()
    {
        return view('komplain.index');
    }

    function json()
    {
        $data = Komplain::latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<a href='. route("komplain.delete", $data->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete(Komplain $komplain)
    {
        $cr = $komplain->delete();
        if($cr){
            return redirect(route("komplain.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("komplain.index"))->with('error', 'Gagal menghapus data');
        }
    }
}
