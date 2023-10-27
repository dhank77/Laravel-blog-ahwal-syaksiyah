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
        ];

        $id = request('id');
        request()->validate($rules);
        
        $formulir = request()->except('_token', 'id');

        if(!$id){
            $slug = Str::slug(request('nama'));
        }else{
            $slug = Formulir::where('id', $id)->value('slug');
            if($slug == ""){
                $slug = Str::slug(request('nama'));
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

}