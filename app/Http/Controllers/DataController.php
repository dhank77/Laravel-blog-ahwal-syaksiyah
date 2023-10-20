<?php

namespace App\Http\Controllers;

use App\Imports\SuratImport;
use App\Models\Data;
use App\Models\DataDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
        if($data->file != ""){
            Storage::delete($data->file);
        }
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
            'file' => 'max:2048|max:2048|mimes:docx',
        ];

        $id = request('id');
        if(!$id){
            $rules['file'] = "required|max:2048|mimes:docx";
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

    public function param_edit(Data $data, DataDetail $dataDetail)
    {
        return view('persuratan.param', compact('data', 'dataDetail'));
    }

    public function download($id)
    {
        if(env('CURL_CA_BUNDLE') != ""){
            ini_set('curl.cainfo', env('CURL_CA_BUNDLE'));
        }

        $dataDetail = DataDetail::where('id', $id)->first();
        $data = Data::where('id', $dataDetail->data_id)->first();

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

    function import()
    {
        $rules = [
            'data_id' => 'required|string',
            'file' => 'max:2048|max:2048|mimes:xls,xlsx,csv',
        ];

        request()->validate($rules);

        $file = request()->file('file');

        try {
            Excel::import(new SuratImport, $file);
            return redirect(route('persuratan.surat', request('data_id')))->with('success', 'Berhasil import data');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect(route('persuratan.surat', request('data_id')))->with('error', 'Terjadi Kesalahan');
        }

    }

    public function param_delete(DataDetail $dataDetail)
    {
        $cr = $dataDetail->delete();
        if($cr){
            return redirect(route("persuratan.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("persuratan.index"))->with('error', 'Gagal menghapus data');
        }
    }
}
