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
        $dataPemberianBantuan = PemberianBantuan::select('tanggal_bantuan')->groupBy('tanggal_bantuan')->orderBy('tanggal_bantuan', 'asc')->get();
        $dataJumlahPenerimaPerTanggal = DB::table('pemberian_bantuan')->select('tanggal_bantuan', DB::raw('COUNT(*) AS total'))->groupBy('tanggal_bantuan')->orderBy('tanggal_bantuan', 'asc')->get();
        foreach ($dataPemberianBantuan as $key) {
            $dataS[] = $key->tanggal_bantuan;
        }

        // foreach ($dataJumlahPenerimaPerTanggal as $key) {
        //     // $dataT[] = '{t: \"' . $key->tanggal_bantuan . '\", y: ' . $key->total . '}';
        //     $dataT[] = $key->tanggal_bantuan;
        //     $dataU[] = $key->total;

        // }
        // dd($dataT);
        // dd("'" . $dataS[0] . "'" . "," . $dataS[1]);
        // dd("2021-01-01", "2021-02-01", "2021-03-01", "2021-04-01", "2021-05-01", "2021-06-01");

        return view('dashboard.dashboard', compact(['dataS', 'dataJumlahPenerimaPerTanggal']));
    }

    public function bantuan()
    {
        $data = PemberianBantuan::
                leftJoin('bantuan', 'pemberian_bantuan.id_bantuan', '=', 'bantuan.id_bantuan')
                ->select('bantuan.nama_bantuan', 'bantuan.id_bantuan', DB::raw('COUNT(*) AS total'))
                ->groupBy('bantuan.nama_bantuan', 'bantuan.id_bantuan')                
                ->get();

        return view('dashboard.bantuan', compact("data"));

    }

}
