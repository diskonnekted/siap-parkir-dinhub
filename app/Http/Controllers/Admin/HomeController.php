<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $perorangan = DB::table('pengelola_perorangan')->count();
        $badan = DB::table('pengelola_badan')->count();
        $jukir = DB::table('juru_parkir')->count();
        $tikir = DB::table('titik_parkir')->count();

        $pengaduan = DB::table('pengaduan')
            ->orderBy('id_pengaduan', 'DESC')
            ->get();

        $pengaduan_jukir = DB::table('pengaduan_jukir as pj')
            ->select('pj.*', 'jp.nama as nama_jukir', 'tp.nama_lokasi')
            ->leftJoin('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'pj.id_juru_parkir')
            ->leftJoin('titik_jukir as tj', 'tj.id_juru_parkir', '=', 'pj.id_juru_parkir')
            ->leftJoin('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->orderBy('id_pengaduan_jukir', 'DESC')
            ->get();

        return view('admin.home', compact('perorangan', 'badan', 'jukir', 'tikir', 'pengaduan', 'pengaduan_jukir'));
    }
}
