<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function komplain()
    {
        return view('frontend.komplain');
    }

    public function komplain_store()
    {
        $data = request()->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|integer',
            'isi' => 'required|string',
            'posisi' => 'required|string',
        ]);

        $cr = Komplain::create($data);
        if($cr){
            return redirect(route("komplain"))->with('success', 'Berhasil memberikan komplain');
        }else{
            return redirect(route("komplain"))->with('error', 'Gagal memberikan komplain');
        }
    }
}
