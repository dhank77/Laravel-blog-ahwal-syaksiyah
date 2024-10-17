<?php

namespace App\Http\Controllers;

use App\Models\SoalSurvey;
use Illuminate\Http\Request;

class SoalSurveyController extends Controller
{
    public function index()
    {
        $soalSurvey = SoalSurvey::latest()->get();
        return view('soalSurvey.index', compact('soalSurvey'));
    }

    public function add()
    {
        $soalSurvey  = new SoalSurvey();
        return view('soalSurvey.add', compact('soalSurvey'));
    }
    public function edit(SoalSurvey $soalSurvey)
    {
        return view('soalSurvey.add', compact('soalSurvey'));
    }

    public function delete(SoalSurvey $soalSurvey)
    {
        $cr = $soalSurvey->delete();
        if($cr){
            return redirect(route("setting.soalSurvey.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("setting.soalSurvey.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'soal' => 'required|string',
            'pilihan1' => 'nullable',
            'pilihan2' => 'nullable',
            'pilihan3' => 'nullable',
            'pilihan4' => 'nullable',
            'pilihan5' => 'nullable',
            'is_active' => 'required',
        ];
        
        $id = request('id');
        if(!$id) {
            $soal = SoalSurvey::count();
            if($soal >= 20) {
                return redirect(route("setting.soalSurvey.index"))->with('error', 'Soal sudah mencapai batas maksimal');
            }
        }
        $data = request()->validate($rules);

        $cr = SoalSurvey::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("setting.soalSurvey.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("setting.soalSurvey.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
