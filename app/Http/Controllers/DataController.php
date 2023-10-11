<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\DataDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    function index()
    {
        $data = Data::latest()->get();
        return view('persuratan.index', compact('data'));
    }

    public function add()
    {
        $data  = new Data();
        return view('persuratan.add', compact('data'));
    }

    public function edit(Data $data)
    {
        return view('persuratan.add', compact('data'));
    }

    public function delete(Data $data)
    {
        $cr = $data->delete();
        if($cr){
            return redirect(route("persuratan.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("persuratan.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'file' => 'max:2048|max:2048|mimes:docx,doc',
        ];

        
        $id = request('id');
        if(!$id){
            $rules['file'] = "required|max:2048|mimes:docx,doc";
        }
        request()->validate($rules);
        
        $data = request()->except('_token', 'id');

        if(request()->file('file')){
            if($id){
                $file = Data::where('id', $id)->value('file');
                Storage::delete($file);
            }

            $data['file'] = request()->file('file')->storeAs("uploads/format", Str::slug(request('nama')) . "-" . date("ymdhis") . "." . request()->file('file')->extension());
        }

        $cr = Data::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("persuratan.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("persuratan.index"))->with('error', 'Gagal memperbaharui data');
        }
    }

    // Data Detail
    function surat(Data $data)
    {
        $dataDetail = DataDetail::where('data_id', $data->id)->latest()->get();
        return view('persuratan.surat', compact('data', 'dataDetail'));
    }

    public function param(Data $data)
    {
        $dataDetail = new DataDetail();
        return view('persuratan.param', compact('data', 'dataDetail'));
    }

    public function download($id)
    {
        $dataDetail = DataDetail::where('id', $id)->first();
        $data = Data::where('id', $dataDetail->data_id)->first();

        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path("app/public/$data->file"));

        $template->setValue('nama', $dataDetail->nama);
        $template->setValue('nim', $dataDetail->nim);
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

    function param_store()
    {
        $rules = [
            'data_id' => 'nullable',
            'nama' => 'nullable',
            'nim' => 'nullable',
            'param1' => 'nullable',
            'param2' => 'nullable',
            'param3' => 'nullable',
            'param4' => 'nullable',
            'param5' => 'nullable',
            'param6' => 'nullable',
            'param7' => 'nullable',
            'param8' => 'nullable',
            'param9' => 'nullable',
        ];
        
        $data = request()->validate($rules);

        $id = request('id');
        $cr = DataDetail::updateOrCreate(['id' => $id], $data);

        if($cr){
            return redirect(route('persuratan.surat', request('data_id')))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route('persuratan.surat', request('data_id')))->with('error', 'Gagal memperbaharui data');
        }
    }
}
