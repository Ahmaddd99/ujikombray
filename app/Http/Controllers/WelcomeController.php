<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(){
        $landing = Pengaduan::all();
        $total_pengaduan = Pengaduan::all()->count();
        return view('welcome', compact('landing','total_pengaduan'));
    }
    public function getPengaduan(){
        $data = Pengaduan::where('nik', Auth::user()->nik)->get();
        return datatables()->of($data)->make(true);
    }
}
