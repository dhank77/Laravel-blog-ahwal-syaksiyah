<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index()
    {
        $user = User::role('admin')->where('id', '!=', auth()->user()->id)->latest()->get();
        return view('admin.super.index', compact('user'));
    }

    public function add()
    {
        $user  = new User();
        return view('admin.super.add', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.super.add', compact('user'));
    }

    public function reset(User $user)
    {
        $cr = $user->update(['password' => bcrypt($user->email)]);
        if($cr){
            return redirect(route("admin.super.index"))->with('success', 'Berhasil mereset data');
        }else{
            return redirect(route("admin.super.index"))->with('error', 'Gagal mereset data');
        }
    }

    public function delete(User $user)
    {
        $cr = $user->delete();
        if($cr){
            return redirect(route("admin.super.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("admin.super.index"))->with('error', 'Gagal menghapus data');
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
        if(!$id){
            $data['password'] = bcrypt($data['email']);
            $cr = User::create($data);
            $cr->assignRole('admin');
        }else{
            $cr = User::where('id', $id)->update($data);
        }
        
        if($cr){
            return redirect(route("admin.super.index"))->with('success', 'Berhasil memperbaharui data');
        }else{
            return redirect(route("admin.super.index"))->with('error', 'Gagal memperbaharui data');
        }
    }
}
