<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TitikController extends Controller
{
    public function index()
    {
        $res = DB::table('titik_parkir as tp')
            ->select('tp.*', 'rj.nama_ruas', 'wc.nama as kec', 'wd.nama as desa')
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->orderBy('id_titik_parkir', 'DESC')
            ->get();

        return view('admin.titik.index', compact('res'));
    }

    public function read($id)
    {
        $row = DB::table('titik_parkir as tp')
            ->select('tp.*', 'rj.*', 'wc.nama as kec', 'wd.nama as desa')
            ->join('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->where('id_titik_parkir', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.titik.index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.titik.read', compact('row'));
    }

    public function delete($id)
    {
        $affected = DB::table('titik_parkir')->where('id_titik_parkir', $id)->delete();
        if ($affected) {
            return redirect()->route('admin.titik.index')->with('message', 'Data berhasil dihapus');
        }
        return redirect()->route('admin.titik.index')->with('message', 'Data tidak ditemukan');
    }
}
