<?php

namespace App\Http\Controllers;

use App\Models\Master\Komponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    public function index()
    {
        $komponen = Komponen::where('nama', 'sambutan')->first();
        return view('sambutan.index', compact('komponen'));
    }

    public function store()
    {
        $rules = [
            'komponen1' => 'required|string',
            'komponen2' => 'nullable',
            'komponen4' => 'nullable',
            'komponen3' => 'max:2048|mimes:png,jpg,jpeg',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['komponen3'] = "required|max:2048|mimes:png,jpg,jpeg";
        }
        $data = request()->validate($rules);

        if(request()->file('komponen3')){
            if($id){
                $img = Komponen::where('id', $id)->value('komponen3');
                if($img){
                    Storage::delete($img);
                }
            }

            $data['komponen3'] = request()->file('komponen3')->storeAs("uploads/sambutan", date("ymdhis") . "." . request()->file('komponen3')->extension());
        }

        $cr = Komponen::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("setting.sambutan.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("setting.sambutan.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
