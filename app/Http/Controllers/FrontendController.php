<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Banner;
use App\Models\Data;
use App\Models\DataDetail;
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
        $data = Data::orderBy('nama')->where('is_public', 1)->get();
        return view('frontend.download', compact('download', 'data'));
    }

    function daftar_data(Data $data)
    {
        $dataDetail = DataDetail::where('data_id', $data->id)->get();
        return view('frontend.data', compact('dataDetail', 'data'));
    }

    function form_data(Data $data)
    {
        return view('frontend.form_data', compact('data'));
    }

    function create_pdf($id)
    {
        $id = base64_decode($id);
        $dataDetail= DataDetail::where('id', $id)->first();
        $data = Data::where('id', $dataDetail->data_id)->first();

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', $dataDetail->nama);
        $template->setValue('nim', $dataDetail->nim);
        $template->setValue('tanggal_hari_ini', tanggal_indo(date("Y-m-d")));
        for ($i=1; $i <= 9 ; $i++) { 
            $params = "param$i";
            $template->setValue($params, $dataDetail->$params);
        }
 
        $saveDocPath = public_path('new-result' . date("ymdhis") . '.docx');
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        set_time_limit(0); 
        $link = "https://psg4-word-view.officeapps.live.com/wv/WordViewer/request.pdf?WOPIsrc=http%3A%2F%2Fpsg3-view-wopi%2Ewopi%2Eonline%2Eoffice%2Enet%3A808%2Foh%2Fwopi%2Ffiles%2F%40%2FwFileId%3FwFileId%3D$paramsUrl&access_token=1&access_token_ttl=0&z=dce785126488e4f952cc69b50e330603d7517b89c1f01bd14796eee9b097a030&type=downloadpdf&useNamedAction=1";
        $file = file_get_contents($link);

        $name = 'new-result.pdf';
        $savePdfPath = public_path($name);
        if (file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }
        file_put_contents($name, $file);
        
        if (file_exists($saveDocPath) ) {
            unlink($saveDocPath);
        }

        return redirect($name);
    }

    function form_data_store($id)
    {
        $id = base64_decode($id);
        $data = Data::where('id', $id)->first();

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', request('nama'));
        $template->setValue('nim', request('nim'));
        $template->setValue('tanggal_hari_ini', tanggal_indo(date("Y-m-d")));
        for ($i=1; $i <= 9 ; $i++) { 
            $params = "param$i";
            $template->setValue($params, request($params));
        }
 
        $saveDocPath = public_path('new-result' . date("ymdhis") . '.docx');
        $template->saveAs($saveDocPath);

        $paramsUrl = url("new-result" . date("ymdhis") . ".docx");
        set_time_limit(0); 
        $link = "https://psg4-word-view.officeapps.live.com/wv/WordViewer/request.pdf?WOPIsrc=http%3A%2F%2Fpsg3-view-wopi%2Ewopi%2Eonline%2Eoffice%2Enet%3A808%2Foh%2Fwopi%2Ffiles%2F%40%2FwFileId%3FwFileId%3D$paramsUrl&access_token=1&access_token_ttl=0&z=dce785126488e4f952cc69b50e330603d7517b89c1f01bd14796eee9b097a030&type=downloadpdf&useNamedAction=1";
        $file = file_get_contents($link);

        $name = 'new-result.pdf';
        $savePdfPath = public_path($name);
        if (file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }
        file_put_contents($name, $file);
        
        if (file_exists($saveDocPath) ) {
            unlink($saveDocPath);
        }

        return redirect($name);
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
