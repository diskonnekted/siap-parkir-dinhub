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

    public function peta_json()
    {
        $titikParkir = DB::table('titik_parkir as tp')
            ->select(
                'tp.id_titik_parkir',
                'tp.nama_lokasi',
                'tp.titik_lat',
                'tp.titik_lng',
                'tp.id_ruas_jalan',
                'rj.nama_ruas',
                'rj.from_lat',
                'rj.from_lng',
                'rj.to_lat',
                'rj.to_lng'
            )
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->whereNotNull('tp.titik_lat')
            ->where('tp.titik_lat', '!=', 0)
            ->get();

        $titikJukir = DB::table('titik_jukir as tj')
            ->select(
                'tj.id_titik_jukir',
                'tj.id_titik_parkir',
                'tj.id_juru_parkir',
                'jp.nama as nama_jukir',
                'jp.no_juru_parkir',
                'tp.nama_lokasi',
                'tp.titik_lat',
                'tp.titik_lng'
            )
            ->leftJoin('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->leftJoin('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->get();

        $ruasJalan = DB::table('ruas_jalan')
            ->select('id_ruas_jalan', 'nama_ruas', 'from_lat', 'from_lng', 'to_lat', 'to_lng')
            ->where('from_lat', '!=', 0)
            ->whereNotNull('from_lat')
            ->get();

        return response()->json([
            'titik_parkir' => $titikParkir,
            'titik_jukir' => $titikJukir,
            'ruas_jalan' => $ruasJalan,
        ]);
    }
}
