<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use App\Models\Master\Kategori;
use App\Models\Master\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('nama')->get();
        $halaman = Halaman::latest()->get();
        $menu_utama = Menu::whereNull('parent_id')->orderBy('urutan')->get();
        return view('master.menu.index', compact('kategori', 'halaman', 'menu_utama'));
    }

    public function store()
    {
        $data = request()->validate([
            'nama' => 'required|string',
            'parent_id' => 'nullable'
        ]);

        $data['link'] = request(request('pilihan'));
        if($data['link'] == ""){
            throw ValidationException::withMessages([
                request('pilihan') => 'Isian link Wajib diisi.',
            ]);
        }

        if(request('parent_id') == ""){
            $data['urutan'] = Menu::whereNull('parent_id')->count() + 1;
        }else{
            $data['urutan'] = Menu::where('parent_id', request('parent_id'))->count() + 1;
        }

        $id = request('id');

        $cr =  Menu::updateOrCreate(["id" => $id], $data);

        if ($cr) {
            return redirect(route("utama.menu.index"))->with('success', 'Berhasil memperbaharui data');
        } else {
            return redirect(route("utama.menu.index"))->with('error', 'Gagal memperbaharui data');
        }
    }

    public function delete(Menu $menu)
    {
        Menu::where('parent_id', $menu->id)->delete();
        $cr = $menu->delete();
        if($cr){
            return redirect(route("utama.menu.index"))->with('success', 'Berhasil menghapus data');
        }else{
            return redirect(route("utama.menu.index"))->with('error', 'Gagal menghapus data');
        }
    }

    public function up(Menu $menu)
    {
        if($menu->parent_id == ""){
            Menu::where('urutan', $menu->urutan-1)->update(['urutan' => $menu->urutan]);
        }else{
            Menu::where('parent_id', $menu->parent_id)->where('urutan', $menu->urutan-1)->update(['urutan' => $menu->urutan]);
        }
        $menu->update(['urutan' => $menu->urutan-1]);

        return redirect()->back();
    }

    public function down(Menu $menu)
    {
        if($menu->parent_id == ""){
            Menu::where('urutan', $menu->urutan+1)->update(['urutan' => $menu->urutan]);
        }else{
            Menu::where('parent_id', $menu->parent_id)->where('urutan', $menu->urutan+1)->update(['urutan' => $menu->urutan]);
        }
        $menu->update(['urutan' => $menu->urutan+1]);

        return redirect()->back();
    }
}
