<?php

namespace App\Http\Controllers;

use App\Models\Master\Komponen;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $komponen = Komponen::where('nama', 'footer')->first();
        return view('footer.index', compact('komponen'));
    }

    public function store()
    {
        $rules = [
            'komponen1' => 'max:2048|mimes:png,jpg,jpeg',
            'komponen2' => 'required',
            'komponen3' => 'required',
            'komponen4' => 'required',
            'komponen5' => 'required',
            'komponen6' => 'required',
            'komponen7' => 'required',
            'komponen8' => 'required',
            'komponen9' => 'required',
        ];
        
        $id = request('id');
        if(!$id){
            $rules['komponen1'] = "required|max:2048|mimes:png,jpg,jpeg";
        }
        $data = request()->validate($rules);

        if(request()->file('komponen1')){
            if($id){
                $img = Komponen::where('id', $id)->value('komponen1');
                if($img){
                    Storage::delete($img);
                }
            }

            $data['komponen1'] = request()->file('komponen1')->storeAs("uploads/footer", date("ymdhis") . "." . request()->file('komponen1')->extension());
        }

        $cr = Komponen::updateOrCreate(['id' => $id], $data);
        if($cr){
            return redirect(route("setting.footer.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("setting.footer.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
