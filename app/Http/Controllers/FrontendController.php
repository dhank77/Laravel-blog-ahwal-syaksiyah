<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Banner;
use App\Models\Data;
use App\Models\DataDetail;
use App\Models\Download;
use App\Models\Formulir;
use App\Models\FormulirDetail;
use App\Models\Komplain;
use App\Models\Master\Kategori;
use App\Models\Master\Komponen;
use App\Models\Pengajar;
use App\Models\Pengumuman;
use App\Models\Short;
use App\Models\Testimoni;
use Share;
use Illuminate\Support\Str;

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

    function short($slug)
    {
        $short = Short::where('slug', $slug)->value('url_tujuan');
        abort_if(is_null($short),404);
        return redirect($short);
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

    function daftar_data($slug)
    {
        $data = Data::orderBy('nama')->where('slug', $slug)->first();
        abort_if(is_null($data) || $data->is_public == 0 || $data->is_form == 1, 404);
        $dataDetail = DataDetail::where('data_id', $data->id)->get();
        return view('frontend.data', compact('dataDetail', 'data'));
    }

    function form_data($slug)
    {
        $data = Data::orderBy('nama')->where('slug', $slug)->first();
        abort_if(is_null($data) || $data->is_public == 0 || $data->is_form == 0, 404);
        return view('frontend.form_data', compact('data'));
    }

    function filesurat($slug, $id)
    {
        $id = base64_decode($id);
        if(env('CURL_CA_BUNDLE') != ""){
            ini_set('curl.cainfo', env('CURL_CA_BUNDLE'));
        }
        $dataDetail = DataDetail::where('id', $id)->first();
        abort_if(is_null($dataDetail), 404);
        $data = Data::where('slug', $slug)->first();
        abort_if(is_null($data), 404);

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', $dataDetail->nama);
        $template->setValue('nim', $dataDetail->nim);
        $template->setValue('bulan_romawi', getRomawi(date("m")));
        $template->setValue('tahun_ini', date("Y"));
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

    function isi_form($slug)
    {
        $formulir = Formulir::orderBy('nama')->where('slug', $slug)->first();
        abort_if($formulir->is_aktif == 0, 404);
        return view('frontend.isi_formulir', compact('formulir'));
    }

    function create_pdf($id)
    {
        if(env('CURL_CA_BUNDLE') != ""){
            ini_set('curl.cainfo', env('CURL_CA_BUNDLE'));
        }
        
        $id = base64_decode($id);
        $dataDetail= DataDetail::where('id', $id)->first();
        $data = Data::where('id', $dataDetail->data_id)->first();
        abort_if($data->is_public == 0, 404);

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', $dataDetail->nama);
        $template->setValue('nim', $dataDetail->nim);
        $template->setValue('bulan_romawi', getRomawi(date("m")));
        $template->setValue('tahun_ini', date("Y"));
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
        // $file = convertWordToPdf($paramsUrl);

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
        if(env('CURL_CA_BUNDLE') != ""){
            ini_set('curl.cainfo', env('CURL_CA_BUNDLE'));
        }

        $id = base64_decode($id);
        $data = Data::where('id', $id)->first();
        abort_if($data->is_public == 0 || $data->is_form == 0, 404);
        $rules = [
            'captcha' => 'required|captcha',
        ];

        if($data->is_nama == 1){
            $rules['nama'] = "required";
        }
        if($data->is_nim == 1){
            $rules['nim'] = "required";
        }
        for ($i=1; $i <= 9 ; $i++) { 
            $params = "param$i";
            if($data->$params == 1){
                $rules[$params] = "required";
            }
        }
        request()->validate($rules);

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', request('nama'));
        $template->setValue('nim', request('nim'));
        $template->setValue('bulan_romawi', getRomawi(date("m")));
        $template->setValue('tahun_ini', date("Y"));
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
        // $file = convertWordToPdf($paramsUrl);

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

    function isi_form_store($id)
    {
        $id = base64_decode($id);
        $data = Formulir::where('id', $id)->first();
        abort_if($data->is_aktif == 0, 404);
        $rules = [
            'captcha' => 'required|captcha',
        ];

        $params_uniq = [];
        for ($i=1; $i <= 9 ; $i++) { 
            $params = "param$i";
            if($data->$params == 1){
                $rules[$params] = "required";
            }
            if($data->$params == 3){
                array_push($params_uniq, $i);
            }
        }

        foreach ($params_uniq as $key => $value) {
            $params = "param$value";
            $paramNama = "param_nama$value";
            $keterangan = $data->$paramNama;
            $reqParam = request($params);
            $cek = FormulirDetail::where("formulir_id", $id)->where($params, $reqParam)->first();
            if($cek){
                return redirect()->back()->with('error', "$keterangan $reqParam telah ada pada sistem!");
            }
        }

        for ($i=1; $i <= 5 ; $i++) { 
            $files = "file$i";
            if($data->$files == 1){
                $rules[$files] = "required|max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx,ppt,pptx";
            }
        }
        request()->validate($rules);
        $send = request()->except('captcha', '_token');

        for ($i=1; $i <= 5 ; $i++) { 
            $files = "file$i";
            if($data->param1 == 1){
                $namaFile =  Str::slug(request('param1'));
            }else{
                $namaFile = rand(111111,999999);
            }
            if($data->$files == 1 && request()->file($files)){
                $path = "/formulir/$data->slug";
                $send[$files] = request()->file($files)->storeAs($path, $namaFile . "-" . $files . "-" . date("ymdhis") . "." . request()->file($files)->extension());
            }
        }

        $send['formulir_id'] = $id;
        $cr = FormulirDetail::create($send);
        if($cr){
            return redirect()->back()->with('success', 'Berhasil mengisi form!');
        }else{
            return redirect()->back()->with('error', 'Gagal mengisi form!');
        }
        
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
        request()->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|integer',
            'isi' => 'required|string',
            'posisi' => 'required|string',
            'captcha' => 'required|captcha',
        ]);

        $data = request()->except(['_token', 'captcha']);

        $cr = Komplain::create($data);
        if($cr){
            return redirect(route("komplain"))->with('success', 'Berhasil memberikan komplain');
        }else{
            return redirect(route("komplain"))->with('error', 'Gagal memberikan komplain');
        }
    }
}
