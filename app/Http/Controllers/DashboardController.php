<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $me = Auth::user();
        $pengaduan = Pengaduan::with('masyarakat')->orderBy('tgl_pengaduan', 'DESC')->get();
        $sudah_tanggap = Pengaduan::where('status', 'selesai')->where('nik', $me->nik)->count();
        $belum_tanggap = Pengaduan::where('status', 'proses')->where('nik', $me->nik)->count();
        $belum_verif = Pengaduan::where('status', '0')->where('nik', $me->nik)->count();
        $total_pengaduan = Pengaduan::where('nik', $me->nik)->count();
        
        return view('masyarakat.dashboard', compact('me', 'pengaduan','sudah_tanggap','belum_verif','belum_tanggap','total_pengaduan'));
    }
    public function profile(){
        $me = Auth::user();
        return view('masyarakat.Profile', compact('me'));
    }

    public function getPengaduan(){
        $data = Pengaduan::where('nik', Auth::user()->nik)->get();
        return datatables()->of($data)->make(true);
    }

       
}
