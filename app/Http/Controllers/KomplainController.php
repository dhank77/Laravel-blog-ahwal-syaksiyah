<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    public function index()
    {
        $komplain = Komplain::latest()->get();
        return view('komplain.index', compact('komplain'));
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
