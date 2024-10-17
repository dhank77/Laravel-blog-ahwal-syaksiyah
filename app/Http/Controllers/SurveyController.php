<?php

namespace App\Http\Controllers;

use App\Models\SoalSurvey;
use App\Models\Survey;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SurveyController extends Controller
{
    public function index()
    {
        return view('survey.index');
    }

    function download()
    {
        $data = Survey::latest()->get();
        $soalSurvey = SoalSurvey::where('is_active', 1)->get();
        return view('survey.download', compact('data', 'soalSurvey'));
    }

    function detail(Survey $survey)
    {
        $soalSurvey = SoalSurvey::where('is_active', 1)->get();
        return view('survey.detail', compact('survey', 'soalSurvey'));
    }

    function json()
    {
        $data = Survey::latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<a href='. route("survey.delete", $data->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                $button = '<a href='. route("survey.detail", $data->id) . ' class="btn btn-success btn-sm">Detail</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete(Survey $survey)
    {
        $cr = $survey->delete();
        if($cr){
            return redirect(route("survey.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("survey.index"))->with('error', 'Gagal menghapus data');
        }
    }
}
