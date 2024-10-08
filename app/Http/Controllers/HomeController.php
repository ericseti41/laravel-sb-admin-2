<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        if (Auth::user()->email == 'admin') {
            $users = User::count();
            $siswainfo = Siswa::count();
            $sekolahinfo = Sekolah::count();

            $widget = [
                'users' => $users,
                //...
            ];
    
            return view('home', compact('widget','siswainfo','sekolahinfo'));

        } else {
            $siswainfo = Siswa::where('sekolah', Auth::user()->npsn)->count();
            $users = User::count();
            $widget = [
                'users' => $users,
                //...
            ];
    
            return view('home', compact('siswainfo'));
        }


    }
}
