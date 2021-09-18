<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bantuan;
use App\PemberianBantuan;
use DB;

class BantuanController extends Controller
{
    public function index()
    {
        $dataBantuan = Bantuan::All();
        $dataPemberianBantuan = PemberianBantuan::All();
        
        foreach ($dataPemberianBantuan as $key) {
            $dataS[] = $key->tanggal_bantuan;
        }

        return view('dashboard.dashboard', compact(['dataS']));
    }

    public function bantuan()
    {
        $data = DB::table('pemberian_bantuan')
                ->leftJoin('warga', 'pemberian_bantuan.nik_warga', '=', 'warga.nik_warga')
                ->leftJoin('bantuan', 'pemberian_bantuan.id_bantuan', '=', 'bantuan.id_bantuan')                
                ->get();

        // DB::table('users')
        // ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        // ->get();

        // dd($data);
        return view('dashboard.bantuan', compact("data"));

    }

}
