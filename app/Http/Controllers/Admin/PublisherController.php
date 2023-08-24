<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use App\Models\User;

class PublisherController extends Controller
{
    public function index()
    {
        $user = User::role('publisher')->latest()->get();
        return view('admin.publisher.index', compact('user'));
    }

    public function add()
    {
        $user  = new User();
        $kategori = Kategori::orderBy('nama')->get();
        return view('admin.publisher.add', compact('user', 'kategori'));
    }

    public function edit(User $user)
    {
        $kategori = Kategori::orderBy('nama')->get();
        return view('admin.publisher.add', compact('user', 'kategori'));
    }

    public function reset(User $user)
    {
        $cr = $user->update(['password' => bcrypt($user->email)]);
        if($cr){
            return redirect(route("admin.publisher.index"))->with('success', 'Berhasil mereset data');
        }else{
            return redirect(route("admin.publisher.index"))->with('error', 'Gagal mereset data');
        }
    }

    public function delete(User $user)
    {
        $cr = $user->delete();
        if($cr){
            return redirect(route("admin.publisher.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("admin.publisher.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
        ];
        
        $id = request('id');
        $data = request()->validate($rules);
        $kategori = "";
        foreach (request('kategori') as $key => $value) {
            if($key == 0){
                $kategori = $value;
            }else{
                $kategori .= "," . $value;
            }
        }
        $data['kategori_id'] = $kategori;
        if(!$id){
            $data['password'] = bcrypt($data['email']);
            $cr = User::create($data);
            $cr->assignRole('publisher');
        }else{
            $cr = User::where('id', $id)->update($data);
        }
        
        if($cr){
            return redirect(route("admin.publisher.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("admin.publisher.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
