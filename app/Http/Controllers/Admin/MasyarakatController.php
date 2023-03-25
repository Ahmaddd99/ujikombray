<?php

namespace App\Http\Controllers\Admin;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasyarakatController extends Controller
{
    public function index(){
        return view('admin.masyarakat.index');
    }

    public function toActive($id){
        try {
            $data = Masyarakat::where('id', $id)->first();
        } catch (\Throwable $th) {
            return [
                'statusCode' => 500,
                'message' => 'Ada masalah teknis silakan coba beberapa saat lagi'
            ];
        }


    }
}
