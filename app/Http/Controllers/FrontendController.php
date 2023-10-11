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

        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', $dataDetail->nama);
        $template->setValue('nim', $dataDetail->nim);
        $template->setValue('tanggal_hari_ini', tanggal_indo(date("Y-m-d")));
        for ($i=1; $i <= 9 ; $i++) { 
            $params = "param$i";
            $template->setValue($params, $dataDetail->$params);
        }
 
        $saveDocPath = public_path('new-result.docx');
        $template->saveAs($saveDocPath);
         
        $Content = \PhpOffice\PhpWord\IOFactory::load($saveDocPath); 
 
        $savePdfPath = public_path('new-result.pdf');
        if ( file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }
 
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        $PDFWriter->save($savePdfPath); 
 
        if ( file_exists($saveDocPath) ) {
            unlink($saveDocPath);
        }

        return redirect('new-result.pdf');
    }

    function form_data_store($id)
    {
        $id = base64_decode($id);
        $data = Data::where('id', $id)->first();

        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', request('nama'));
        $template->setValue('nim', request('nim'));
        $template->setValue('tanggal_hari_ini', tanggal_indo(date("Y-m-d")));
        for ($i=1; $i <= 9 ; $i++) { 
            $params = "param$i";
            $template->setValue($params, request($params));
        }
 
        $saveDocPath = public_path('new-result.docx');
        $template->saveAs($saveDocPath);
         
        $Content = \PhpOffice\PhpWord\IOFactory::load($saveDocPath); 
 
        $savePdfPath = public_path('new-result.pdf');
        if ( file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }
 
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        $PDFWriter->save($savePdfPath); 
 
        if ( file_exists($saveDocPath) ) {
            unlink($saveDocPath);
        }

        return redirect('new-result.pdf');
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
