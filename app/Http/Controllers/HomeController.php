<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Komplain;
use App\Models\Pengajar;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        $berita = Artikel::count();
        $pengumuman = Pengumuman::count();
        $pengajar = Pengajar::count();
        $komplain = Komplain::count();
        return view('index', compact('berita', 'pengumuman', 'pengajar', 'komplain'));
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }

    public function passwordIndex()
    {
        return view('password');
    }

    public function updatePassword()
    {
        $lama = request('password_lama');
        $baru = request('password_baru');
        $konfirmasi = request('password_konfirmasi');

        if($baru == $konfirmasi){
            if(password_verify($lama, auth()->user()->password)){
                $cek = User::where('id', auth()->user()->id)->update(['password' => password_hash($baru, PASSWORD_BCRYPT)]);

                if($cek){
                    return redirect()->back()->with('success', 'Berhasil mengubah password!');
                }else{
                    return redirect()->back()->with('error', 'Gagal, Berhasil mengubah password!');
                }
            }else{
                return redirect()->back()->with('error', 'Gagal, Password Lama tidak benar!');
            }
        }else{
            return redirect()->back()->with('error', 'Gagal, Password Konfirmasi tidak benar!');
        }
    }
}
