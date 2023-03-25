<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index($no_pengaduan){
        $data = Pengaduan::with('masyarakat')->where('no_pengaduan', $no_pengaduan)->firstOrFail();
        if ($data->status == 'selesai') {
            $tanggapan = Tanggapan::with('petugas')->where('id_pengaduan', $data->id_pengaduan)->first();
            return view('admin.tanggapan.detail-done', compact('data', 'tanggapan'));
        }elseif($data->status == 'proses'){
            $tanggapan = Tanggapan::with('petugas')->where('id_pengaduan', $data->id_pengaduan)->first();
            return view('admin.tanggapan.detail', compact('data','tanggapan'));
        }else{
            return view('admin.tanggapan.detail', compact('data'));
        }
    }

    public function verifikasiPengaduan(){

    }
    
    public function createTanggapan(Request $request, $no_pengaduan){
        $pengaduan = Pengaduan::where('no_pengaduan', $no_pengaduan)->first();
        if ($pengaduan) {
            $request->validate([
                'tanggapan' => 'required',
                'status' => 'required',
            ]);

            $tanggapan = Tanggapan::where('id_pengaduan', $pengaduan->id_pengaduan)->first();
            if ($tanggapan) {
                $tanggapan->update([
                    'tgl_tanggapan' => date('Y-m-d'),
                    'tanggapan' => $request->tanggapan,
                    'id_petugas' => Auth::guard('petugas')->user()->id_petugas
                ]);
            } else {
                $code = $this->tanggapanCode();
                Tanggapan::insert([
                'no_tanggapan' => $code,
                'id_pengaduan' => $pengaduan->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                'id_petugas' => Auth::guard('petugas')->user()->id_petugas
            ]);
            }
            $pengaduan->update([
                'status' => $request->status
            ]);

            return redirect()->route('admin.pengaduan-undone')->with('success', 'Tanggapan berhasil diupload');
        }

    }

    public function tanggapanCode(){
        $str = Str::random(20);
        $data = Tanggapan::where('no_tanggapan', $str)->first();
        if ($data) {
            return $this->pengaduanCode();
        }
        return $str;
    }
}
