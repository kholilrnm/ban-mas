<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PemberianBantuan;
use DB;

class PenerimaController extends Controller
{
    public function penerima()
    {
        $data = DB::table('pemberian_bantuan')
                ->leftJoin('warga', 'pemberian_bantuan.nik_warga', '=', 'warga.nik_warga')
                ->select('warga.nokk_warga', 'warga.nama_warga')
                ->groupBy('warga.nik_warga', 'warga.nama_warga')
                ->get();

        return view('dashboard.penerima', compact("data"));
    }

}
