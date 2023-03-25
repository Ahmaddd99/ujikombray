<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tanggapan;

class DatatableController extends Controller
{
    public function masyarakat()
    {
        $data = Masyarakat::get();
        return datatables()->of($data)
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->make(true);
    }

    public function pengaduanPending()
    {
        $data = Pengaduan::with('masyarakat')->where('status', '0')->orWhere('status','0')->get();
        return datatables()->of($data)
            ->editColumn('tgl_pengaduan', function ($row) {
                return date('d F Y h:m:s', strtotime($row->tgl_pengaduan));
            })
            ->addColumn('action', function ($row) {
                if ($row->status == '0') {
                    $id = $row->no_pengaduan;
                    $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-danger">Verifikasi Pengaduan</button>';
                    return $output;
                }
            })
            ->editColumn('status', function($row){
                $status = $row->status;
                if ($row->status == '0') {
                    $status = '<span class="badge rounded-pill p-2 bg-secondary">Belum Diverifikasi</span>';
                }
                return $status;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function pengaduanProgres()
    {
        $data = Pengaduan::with('masyarakat')->where('status', 'proses')->orWhere('status','0')->get();
        return datatables()->of($data)
            ->editColumn('tgl_pengaduan', function ($row) {
                return date('d F Y h:m:s', strtotime($row->tgl_pengaduan));
            })
            ->addColumn('action', function ($row) {
                if ($row->status == '0') {
                    $id = $row->no_pengaduan;
                    $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-danger">Verifikasi Pengaduan</button>';
                    return $output;
                }elseif($row->status == 'proses'){
                    $id = $row->no_pengaduan;
                    $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-warning">Selesaikan Pengaduan</button>';
                    return $output;
                }elseif ($row->status == 'selesai') {
                    $id = $row->no_pengaduan;
                    $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-success">Lihat Tanggapan</button>';
                    return $output;
                }
            })
            ->editColumn('status', function($row){
                $status = $row->status;
                if ($row->status == '0') {
                    $status = '<span class="badge rounded-pill p-2 bg-secondary">Belum Diverifikasi</span>';
                }elseif($row->status == 'proses'){
                    $status = '<span class="badge rounded-pill p-2 bg-warning">Diproses</span>';
                }elseif ($row->status == 'selesai') {
                    $status = '<span class="badge rounded-pill p-2 bg-success">Selesai</span>';
                }
                return $status;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function pengaduanDone()
    {
        $data = Pengaduan::with('masyarakat')->where('status', 'selesai')->get();
        return datatables()->of($data)
            ->editColumn('tgl_pengaduan', function ($row) {
                return date('d F Y h:m:s', strtotime($row->tgl_pengaduan));
                // return date('d F Y', strtotime($row->tgl_pengaduan));
            })
            ->editColumn('foto', function ($row) {
                $foto = asset("img/pengaduan/{$row->foto}");
                $output = '<img class="rounded" style="width:70%; height:100px;" src="' . $foto . '">';
                return $output;
            })
            ->addColumn('tgl_tanggapan', function ($row) {
                $tgl = Tanggapan::where('id_pengaduan', $row->id_pengaduan)->first();
                if($tgl){
                    return date('d F Y h:m:s', strtotime($tgl->tgl_tanggapan));
                }
                return '-';
            })
            ->addColumn('action', function ($row) {
                $id = $row->no_pengaduan;
                $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-success">Lihat Tanggapan</button>';
                return $output;
            })
            ->rawColumns(['action','foto'])
            ->make(true);
    }

    public function pengaduanAll(Request $request)
    {
        $data = Pengaduan::with('masyarakat')->get();
        if ($request->has('month')) {
            if ($request->filled('month')) {
                $data = Pengaduan::with('masyarakat')->whereMonth('tgl_pengaduan', $request->month)->whereYear('tgl_pengaduan', now()->year)->get();
            }
        }
        return datatables()->of($data)
            ->editColumn('tgl_pengaduan', function ($row) {
                return date('d F Y h:m:s', strtotime($row->tgl_pengaduan));
                // return date('d F Y', strtotime($row->tgl_pengaduan));
            })
            ->editColumn('foto', function ($row) {
                $foto = asset("img/pengaduan/{$row->foto}");
                $output = '<img class="rounded" style="width:70%; height:100px;" src="' . $foto . '">';
                return $output;
            })
            ->editColumn('status', function($row){
                $status = $row->status;
                if ($row->status == '0') {
                    $status = '<span class="badge rounded-pill p-2 bg-secondary">Belum di Verifikasi</span>';
                }elseif($row->status == 'proses'){
                    $status = '<span class="badge rounded-pill p-2 bg-warning">Proses</span>';
                }elseif ($row->status == 'selesai') {
                    $status = '<span class="badge rounded-pill p-2 bg-success">Selesai</span>';
                }
                return $status;
            })
            ->addColumn('tgl_tanggapan', function ($row) {
                $tgl = Tanggapan::where('id_pengaduan', $row->id_pengaduan)->first();
                if($tgl){
                    return date('d F Y h:m:s', strtotime($tgl->tgl_tanggapan));
                }
                return '-';
            })
            ->addColumn('action', function ($row) {
                if ($row->status == '0') {
                    $id = $row->no_pengaduan;
                    $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-danger">Verifikasi Pengaduan</button>';
                    return $output;
                }elseif($row->status == 'proses'){
                    $id = $row->no_pengaduan;
                    $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-warning">Selesaikan Pengaduan</button>';
                    return $output;
                }elseif ($row->status == 'selesai') {
                    $id = $row->no_pengaduan;
                    $output = '<button type="button" onclick="responseAduan(\'' . $id . '\')" class="btn btn-success">Lihat Tanggapan</button>';
                    return $output;
                }
            })
            ->rawColumns(['action','foto','status'])
            ->make(true);
    }

    public function petugas()
    {
        $data = Admin::where('level', 'petugas')->get();
        return datatables()->of($data)
            ->addColumn('action', function ($row) {
                $id = $row->id_petugas;
                $output = '<button type="button" onclick="deleteData(\'' . $id . '\')" class="btn btn-danger">Hapus Petugas</button>';
                return $output;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
