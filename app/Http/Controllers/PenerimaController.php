<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PemberianBantuan;
use App\Warga;
use DB;

class PenerimaController extends Controller
{
    public function penerima()
    {
        // $data = PemberianBantuan::All();

        $data = DB::table('pemberian_bantuan')
                ->leftJoin('warga', 'pemberian_bantuan.nik_warga', '=', 'warga.nik_warga')->get();

        // DB::table('users')
        // ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        // ->get();

        // dd($data);
        return view('dashboard.penerima', compact("data"));
    }

    public function show()
    {
        $dataPemberianBantuan = PemberianBantuan::All();
        // dd($dataPemberianBantuan);
        return datatables()->of($dataPemberianBantuan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                
            $data = 
                '
                <button>a</button>
               ';
            return $data;
            })
        ->rawColumns(['action'])
        ->make(true);
    }
}
