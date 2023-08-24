<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Banner;
use App\Models\Download;
use App\Models\Komplain;
use App\Models\Master\Kategori;
use App\Models\Master\Komponen;
use App\Models\Pengajar;
use App\Models\Pengumuman;
use App\Models\Testimoni;
use Share;

class FrontendController extends Controller
{
    public function index()
    {
        $banner = Banner::latest()->get();
        $sambutan = Komponen::where('nama', 'sambutan')->first();
        $testimoni = Testimoni::latest()->get();
        $pengumuman = Pengumuman::latest()->limit(5)->get();
        return view('frontend.index', compact('banner', 'sambutan', 'testimoni', 'pengumuman'));
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
        $berita = Artikel::with('kategori')->latest()->paginate(9);
        return view('frontend.berita', compact('berita'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->paginate(9);
        return view('frontend.pengumuman', compact('pengumuman'));
    }

    public function download()
    {
        $download = Download::orderBy('nama')->where('is_public', 1)->get();
        return view('frontend.download', compact('download'));
    }

    public function kategori(Kategori $kategori)
    {
        $berita = Artikel::with('kategori')->where('kategori_id', $kategori->id)->latest()->paginate(9);
        return view('frontend.kategori', compact('berita', 'kategori'));
    }

    public function post($model, $slug)
    {
        abort_if(!in_array($model, ['halaman', 'artikel', 'pengumuman']), 404);
        $qry = "App\Models\\" . ucfirst($model);
        $slug = "$model/$slug";
        $data = $qry::where('slug', $slug)->first();
        abort_if(!$data, 404);
        $share = Share::currentPage()
                        ->facebook()
                        ->twitter()
                        ->linkedin()
                        ->telegram()
                        ->whatsapp()
                        ->getRawLinks();

        return view('frontend.post', compact('data', 'model', 'share'));
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
