<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    // Masyarakat Complaints
    public function index()
    {
        $res = DB::table('pengaduan')
            ->orderBy('id_pengaduan', 'DESC')
            ->get();

        return view('admin.pengaduan.index', compact('res'));
    }

    public function read($id)
    {
        $row = DB::table('pengaduan')->where('id_pengaduan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.pengaduan.index')->with('message', 'Data tidak ditemukan');
        }
        return view('admin.pengaduan.read', compact('row'));
    }

    public function delete($id)
    {
        DB::table('pengaduan')->where('id_pengaduan', $id)->delete();
        return redirect()->route('admin.pengaduan.index')->with('message', 'Data berhasil dihapus');
    }

    // Jukir Complaints
    public function jukir_index()
    {
        $res = DB::table('pengaduan_jukir as pj')
            ->select('pj.*', 'jp.nama as nama_jukir', 'tp.nama_lokasi')
            ->leftJoin('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'pj.id_juru_parkir')
            ->leftJoin('titik_jukir as tj', 'tj.id_juru_parkir', '=', 'pj.id_juru_parkir')
            ->leftJoin('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->orderBy('id_pengaduan_jukir', 'DESC')
            ->get();

        return view('admin.pengaduan.jukir_index', compact('res'));
    }

    public function jukir_read($id)
    {
        $row = DB::table('pengaduan_jukir as pj')
            ->select('pj.*', 'jp.nama as nama_jukir', 'tp.nama_lokasi')
            ->leftJoin('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'pj.id_juru_parkir')
            ->leftJoin('titik_jukir as tj', 'tj.id_juru_parkir', '=', 'pj.id_juru_parkir')
            ->leftJoin('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->where('id_pengaduan_jukir', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.pengaduan.jukir_index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.pengaduan.jukir_read', compact('row'));
    }

    public function jukir_delete($id)
    {
        DB::table('pengaduan_jukir')->where('id_pengaduan_jukir', $id)->delete();
        return redirect()->route('admin.pengaduan.jukir_index')->with('message', 'Data berhasil dihapus');
    }
}
