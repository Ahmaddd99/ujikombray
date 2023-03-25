<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function index(){
        $month = [
            [
                'value' => '01',
                'month' => 'Januari'
             ],
            [
                'value' => '02',
                'month' => 'Februari'
             ],
            [
                'value' => '03',
                'month' => 'Maret'
             ],
             [
                'value' => '04',
                'month' => 'April'
             ],
            [
                'value' => '05',
                'month' => 'Mei'
             ],
            [
                'value' => '06',
                'month' => 'Juni'
             ],
            [
                'value' => '07',
                'month' => 'Juli'
             ],
            [
                'value' => '08',
                'month' => 'Agustus'
             ],
            [
                'value' => '09',
                'month' => 'September'
             ],
            [
                'value' => '10',
                'month' => 'Oktober'
             ],
            [
                'value' => '11',
                'month' => 'November'
             ],
            [
                'value' => '12',
                'month' => 'Desember'
        	]
        ];
        return view('admin.pengaduan.all',compact('month'));
    }

    public function printAll(Request $request){
        $data = Pengaduan::with('masyarakat')->get();
        if ($request->filled('month')) {
            $data = Pengaduan::with('masyarakat')->whereMonth('tgl_pengaduan', $request->month)->whereYear('tgl_pengaduan', now()->year)->get();
            $dateObj   = DateTime::createFromFormat('!m', $request->month);
            $month = $dateObj->format('F');
            $year = now()->year;
            return view('admin.pengaduan.print', compact('data', 'month', 'year'));
        }
        return view('admin.pengaduan.print', compact('data'));
    }
}
