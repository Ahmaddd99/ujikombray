<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index(){
        $me = Auth::guard('petugas')->user();
        // $pengaduan = Pengaduan::with('masyarakat')->orderBy('tgl_pengaduan', 'DESC')->get();
        $total_user = Masyarakat::count();
        $total_pengaduan = Pengaduan::count();
        $tanggap = Pengaduan::where('status', 'selesai')->count();
        $belum_tanggap = Pengaduan::where('status', 'proses')->count();
        $pengaduan = Pengaduan::where('status', '0')->get();
        $foto = Pengaduan::where('foto');
        return view('admin.dashboard', compact('me', 'total_pengaduan','pengaduan', 'total_user', 'tanggap', 'belum_tanggap','foto'));
    }

    public function getPengaduan(){
        $data = Pengaduan::where('nik', Auth::user()->nik)->get();
        return datatables()->of($data)->make(true);
    }
}
