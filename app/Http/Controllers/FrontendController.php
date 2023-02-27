<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Banner;
use App\Models\Komplain;
use App\Models\Pengajar;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $banner = Banner::latest()->get();
        return view('frontend.index', compact('banner'));
    }

    public function komplain()
    {
        return view('frontend.komplain');
    }

    public function pengajar()
    {
        $pengajar = Pengajar::orderBy('nama')->get();
        return view('frontend.pengajar', compact('pengajar'));
    }

    public function berita()
    {
        $berita = Artikel::latest()->paginate(9);
        return view('frontend.berita', compact('berita'));
    }

    public function post($model, $slug)
    {
        abort_if(!in_array($model, ['halaman', 'artikel']), 404);
        $qry = "App\Models\\" . ucfirst($model);
        $slug = "$model/$slug";
        $data = $qry::where('slug', $slug)->first();
        abort_if(!$data, 404);
        return view('frontend.post', compact('data', 'model'));
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
