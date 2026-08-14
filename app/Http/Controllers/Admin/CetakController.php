<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CetakController extends Controller
{
    public function perorangan()
    {
        $res = DB::table('sk_perorangan as sp')
            ->select('sp.*', 'pp.*', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_perorangan as pp', 'pp.id_pengelola_perorangan', '=', 'sp.id_pengelola_perorangan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.domisili_id_kecamatan')
            ->join('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.domisili_id_kabupaten')
            ->orderBy('id_sk_perorangan', 'DESC')
            ->get();

        return view('admin.cetak.perorangan', compact('res'));
    }

    public function perorangan_read($id)
    {
        $row = DB::table('sk_perorangan as sp')
            ->select('sp.*', 'pp.*', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_perorangan as pp', 'pp.id_pengelola_perorangan', '=', 'sp.id_pengelola_perorangan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.domisili_id_kecamatan')
            ->join('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.domisili_id_kabupaten')
            ->where('id_sk_perorangan', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.cetak.perorangan')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.cetak.perorangan_read', compact('row'));
    }

    public function perorangan_delete($id)
    {
        DB::table('sk_perorangan')->where('id_sk_perorangan', $id)->delete();
        return redirect()->route('admin.cetak.perorangan')->with('message', 'Data berhasil dihapus');
    }

    public function badan()
    {
        $res = DB::table('sk_badan as sb')
            ->select('sb.*', 'pb.*', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_badan as pb', 'pb.id_pengelola_badan', '=', 'sb.id_pengelola_badan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'pb.id_kecamatan')
            ->join('wilayah_kabupaten as wk', 'wk.id', '=', 'pb.id_kabupaten')
            ->orderBy('id_sk_badan', 'DESC')
            ->get();

        return view('admin.cetak.badan', compact('res'));
    }

    public function badan_read($id)
    {
        $row = DB::table('sk_badan as sb')
            ->select('sb.*', 'pb.*', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_badan as pb', 'pb.id_pengelola_badan', '=', 'sb.id_pengelola_badan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'pb.id_kecamatan')
            ->join('wilayah_kabupaten as wk', 'wk.id', '=', 'pb.id_kabupaten')
            ->where('id_sk_badan', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.cetak.badan')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.cetak.badan_read', compact('row'));
    }

    public function badan_delete($id)
    {
        DB::table('sk_badan')->where('id_sk_badan', $id)->delete();
        return redirect()->route('admin.cetak.badan')->with('message', 'Data berhasil dihapus');
    }
}
