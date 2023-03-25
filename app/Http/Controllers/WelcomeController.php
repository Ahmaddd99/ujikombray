<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(Request $request){
        $pengaduan = Pengaduan::with('masyarakat')->orderBy('tgl_pengaduan', 'DESC')->get();
        return view('welcome', compact('pengaduan'));
    }
    public function getPengaduan(){
        $data = Pengaduan::where('nik', Auth::user()->nik)->get();
        return datatables()->of($data)->make(true);
    }

}
