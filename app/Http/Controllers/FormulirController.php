<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\FormulirDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use ZipArchive;

class FormulirController extends Controller
{
    function index()
    {
        return view('formulir.index');
    }

    function json()
    {
        $formulir = Formulir::latest();

        return DataTables::of($formulir)
            ->addIndexColumn()
            ->addColumn('link', function ($formulir) {
                $link = url("form/$formulir->slug");
                return "<a href='$link'>$link</a>";
            })
            ->addColumn('jumlah', function ($formulir) {
                return jumlahPendaftarFormulir($formulir->id);
            })
            ->addColumn('action', function ($formulir) {
                $button = '<a href='. route("formulir.detail", $formulir->id) . ' class="btn btn-success btn-sm">Detail</a>';
                $button .= '<a href='. route("formulir.edit", $formulir->id) . ' class="btn btn-primary btn-sm">Edit</a>';
                $button .= '<a href='. route("formulir.delete", $formulir->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                return $button;
            })
            ->rawColumns(['action', 'link'])
            ->make(true);
    }

    public function add()
    {
        $formulir  = new Formulir();
        return view('formulir.add', compact('formulir'));
    }

    public function edit(Formulir $formulir)
    {
        return view('formulir.add', compact('formulir'));
    }

    public function delete(Formulir $formulir)
    {
        for ($i=1; $i <= 5; $i++) { 
            $field = "file$i";
            if($formulir->$field != ""){
                Storage::delete($formulir->$field);
            }
        }
        $cr = $formulir->delete();
        if($cr){
            return redirect(route("formulir.index"))->with('success', 'Berhasil menghapus formulir');
        }else{
            return redirect(route("formulir.index"))->with('error', 'Gagal menghapus formulir');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'pesan_selesai' => 'required',
        ];

        $id = request('id');
        request()->validate($rules);
        
        $formulir = request()->except('_token', 'id', 'files');

        if(!$id){
            $slug = Str::slug(request('nama')) ."-". generateRandomString(3);
        }else{
            $slug = Formulir::where('id', $id)->value('slug');
            if($slug == ""){
                $slug = Str::slug(request('nama')) ."-". generateRandomString(3);
            }
        }

        $formulir['slug'] = $slug;

        $cr = Formulir::updateOrCreate(['id' => $id], $formulir);
        if($cr){
            return redirect(route("formulir.index"))->with('success', 'Berhasil memperbaharui formulir');
        }else{
            return redirect(route("formulir.index"))->with('error', 'Gagal memperbaharui formulir');
        }
    }

    function detail(Formulir $formulir)
    {   
        $formulirDetail = FormulirDetail::where('formulir_id', $formulir->id)->get();
        return view('formulir.detail',compact('formulirDetail', 'formulir'));
    }

    function download_file(Formulir $formulir)
    {
        $zip = new ZipArchive;
        $slug = $formulir->slug;
        if (true === ($zip->open("$slug.zip", ZipArchive::CREATE | ZipArchive::OVERWRITE))) {
            $path = storage_path("app/public/formulir/$slug");
            $files = File::allFiles($path);
            
            foreach ($files as $file) {
                $name = basename($file);
                if ($name !== '.gitignore') {
                    $zip->addFile(storage_path("app/public/formulir/$slug/$name"), $name);
                }
            }
            $zip->close();
        }
    
        return response()->download(public_path("$slug.zip"), "$slug.zip");
    }

    function download_xls(Formulir $formulir)
    {
        $formulirDetail = FormulirDetail::where("formulir_id", $formulir->id)->get();
        return view("formulir.download", compact("formulirDetail","formulir"));
    }

    // Formulir Detail
    function detail_add(Formulir $formulir)
    {
        $formulirDetail = new FormulirDetail();
        return view("formulir.detail_edit", compact("formulir","formulirDetail"));
    }

    function detail_edit(Formulir $formulir, FormulirDetail $formulirDetail)
    {
        abort_if($formulir->id != $formulirDetail->formulir_id, 404);
        return view("formulir.detail_edit", compact("formulir","formulirDetail"));
    }

    function detail_store(Formulir $formulir)
    {
        $data = $formulir;
        $id = $formulir->id;
        $fdId = request('id');
        $rules = [];

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

        if($fdId == ""){
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
        }

        for ($i=1; $i <= 5 ; $i++) { 
            $files = "file$i";
            if($data->$files == 1 && $fdId == ""){
                $rules[$files] = "required|max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx,ppt,pptx";
            }
        }
        request()->validate($rules);
        $send = request()->except('captcha', '_token', 'file1', 'file2', 'file3', 'file4', 'file5');

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
        $cr = FormulirDetail::updateOrCreate(['id' => $fdId], $send);
        if($cr){
            return redirect(route("formulir.detail", $id))->with('success', 'Berhasil mengisi form!');
        }else{
            return redirect(route("formulir.detail", $id))->with('error', 'Gagal mengisi form!');
        }
    }
    
    function detail_delete(Formulir $formulir, FormulirDetail $formulirDetail)
    {
        abort_if($formulir->id != $formulirDetail->formulir_id, 404);
        for ($i=1; $i <= 5; $i++) { 
            $field = "file$i";
            if($formulirDetail->$field != ""){
                Storage::delete($formulirDetail->$field);
            }
        }
        $cr = $formulirDetail->delete();
        if($cr){
            return redirect()->back()->with('success', 'Berhasil menghapus formulir');
        }else{
            return redirect()->back()->with('error', 'Gagal menghapus formulir');
        }
    }

}