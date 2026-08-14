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
            ->select('sp.*', 'pp.nama', 'pp.nik', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_perorangan as pp', 'pp.id_pengelola_perorangan', '=', 'sp.id_pengelola_perorangan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.domisili_id_kecamatan')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.domisili_id_kabupaten')
            ->orderBy('id_sk_perorangan', 'DESC')
            ->get();

        return view('admin.cetak.perorangan', compact('res'));
    }

    public function perorangan_read($id)
    {
        $row = DB::table('sk_perorangan as sp')
            ->select('sp.*', 'pp.nama', 'pp.nik', 'pp.alamat', 'pp.no_telp', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_perorangan as pp', 'pp.id_pengelola_perorangan', '=', 'sp.id_pengelola_perorangan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.domisili_id_kecamatan')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.domisili_id_kabupaten')
            ->where('id_sk_perorangan', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.cetak.perorangan')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.cetak.perorangan_read', compact('row'));
    }

    public function perorangan_add()
    {
        $tahun_active = DB::table('tahun_pengelolaan')->where('actived', 1)->first();
        $tahun = $tahun_active ? $tahun_active->tahun_pengelolaan : date('Y');

        $arr_perorangan = DB::table('pengelola_perorangan as pp')
            ->select('pp.id_pengelola_perorangan', 'pp.nama', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->where('pp.verifikasi', 1)
            ->get();

        return view('admin.cetak.perorangan_form', [
            'button' => 'Tambah',
            'action' => route('admin.cetak.perorangan_add_action'),
            'id_sk_perorangan' => '',
            'tahun_pengelolaan' => $tahun,
            'id_pengelola_perorangan' => '',
            'jenis_lokasi' => '',
            'nama_lokasi' => '',
            'zona' => '',
            'no_sk' => '',
            'hari_sk' => '',
            'tgl_sk' => date('Y-m-d'),
            'retribusi_perbulan' => '',
            'retribusi_pertahun' => '',
            'arr_perorangan' => $arr_perorangan,
        ]);
    }

    public function perorangan_add_action(Request $request)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
            'id_pengelola_perorangan' => 'required',
            'jenis_lokasi' => 'required',
            'nama_lokasi' => 'required',
            'zona' => 'required',
            'no_sk' => 'required',
            'hari_sk' => 'required',
            'tgl_sk' => 'required|date',
            'retribusi_perbulan' => 'required|numeric',
            'retribusi_pertahun' => 'required|numeric',
        ]);

        DB::table('sk_perorangan')->insert([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'id_pengelola_perorangan' => $request->input('id_pengelola_perorangan'),
            'jenis_lokasi' => $request->input('jenis_lokasi'),
            'nama_lokasi' => $request->input('nama_lokasi'),
            'zona' => $request->input('zona'),
            'no_sk' => $request->input('no_sk'),
            'hari_sk' => $request->input('hari_sk'),
            'tgl_sk' => $request->input('tgl_sk'),
            'retribusi_perbulan' => $request->input('retribusi_perbulan'),
            'retribusi_pertahun' => $request->input('retribusi_pertahun'),
            'printed' => 0,
        ]);

        return redirect()->route('admin.cetak.perorangan')->with('message', 'Data SK berhasil disimpan');
    }

    public function perorangan_update($id)
    {
        $row = DB::table('sk_perorangan')->where('id_sk_perorangan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.cetak.perorangan')->with('message', 'Data tidak ditemukan');
        }

        $arr_perorangan = DB::table('pengelola_perorangan as pp')
            ->select('pp.id_pengelola_perorangan', 'pp.nama', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->where('pp.verifikasi', 1)
            ->get();

        return view('admin.cetak.perorangan_form', [
            'button' => 'Simpan',
            'action' => route('admin.cetak.perorangan_update_action', $id),
            'id_sk_perorangan' => $row->id_sk_perorangan,
            'tahun_pengelolaan' => old('tahun_pengelolaan', $row->tahun_pengelolaan),
            'id_pengelola_perorangan' => old('id_pengelola_perorangan', $row->id_pengelola_perorangan),
            'jenis_lokasi' => old('jenis_lokasi', $row->jenis_lokasi),
            'nama_lokasi' => old('nama_lokasi', $row->nama_lokasi),
            'zona' => old('zona', $row->zona),
            'no_sk' => old('no_sk', $row->no_sk),
            'hari_sk' => old('hari_sk', $row->hari_sk),
            'tgl_sk' => old('tgl_sk', $row->tgl_sk),
            'retribusi_perbulan' => old('retribusi_perbulan', $row->retribusi_perbulan),
            'retribusi_pertahun' => old('retribusi_pertahun', $row->retribusi_pertahun),
            'arr_perorangan' => $arr_perorangan,
        ]);
    }

    public function perorangan_update_action(Request $request, $id)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
            'id_pengelola_perorangan' => 'required',
            'jenis_lokasi' => 'required',
            'nama_lokasi' => 'required',
            'zona' => 'required',
            'no_sk' => 'required',
            'hari_sk' => 'required',
            'tgl_sk' => 'required|date',
            'retribusi_perbulan' => 'required|numeric',
            'retribusi_pertahun' => 'required|numeric',
        ]);

        DB::table('sk_perorangan')->where('id_sk_perorangan', $id)->update([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'id_pengelola_perorangan' => $request->input('id_pengelola_perorangan'),
            'jenis_lokasi' => $request->input('jenis_lokasi'),
            'nama_lokasi' => $request->input('nama_lokasi'),
            'zona' => $request->input('zona'),
            'no_sk' => $request->input('no_sk'),
            'hari_sk' => $request->input('hari_sk'),
            'tgl_sk' => $request->input('tgl_sk'),
            'retribusi_perbulan' => $request->input('retribusi_perbulan'),
            'retribusi_pertahun' => $request->input('retribusi_pertahun'),
        ]);

        return redirect()->route('admin.cetak.perorangan')->with('message', 'Data SK berhasil diupdate');
    }

    public function perorangan_delete($id)
    {
        DB::table('sk_perorangan')->where('id_sk_perorangan', $id)->delete();
        return redirect()->route('admin.cetak.perorangan')->with('message', 'Data berhasil dihapus');
    }

    public function badan()
    {
        $res = DB::table('sk_badan as sb')
            ->select('sb.*', 'pb.nama_badan', 'pb.npwp', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_badan as pb', 'pb.id_pengelola_badan', '=', 'sb.id_pengelola_badan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pb.id_kecamatan')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pb.id_kabupaten')
            ->orderBy('id_sk_badan', 'DESC')
            ->get();

        return view('admin.cetak.badan', compact('res'));
    }

    public function badan_read($id)
    {
        $row = DB::table('sk_badan as sb')
            ->select('sb.*', 'pb.nama_badan', 'pb.npwp', 'pb.alamat_kantor', 'pb.no_telp', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_badan as pb', 'pb.id_pengelola_badan', '=', 'sb.id_pengelola_badan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pb.id_kecamatan')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pb.id_kabupaten')
            ->where('id_sk_badan', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.cetak.badan')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.cetak.badan_read', compact('row'));
    }

    public function badan_add()
    {
        $tahun_active = DB::table('tahun_pengelolaan')->where('actived', 1)->first();
        $tahun = $tahun_active ? $tahun_active->tahun_pengelolaan : date('Y');

        $arr_badan = DB::table('pengelola_badan as pb')
            ->select('pb.id_pengelola_badan', 'pb.nama_badan', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->where('pb.verifikasi', 1)
            ->get();

        return view('admin.cetak.badan_form', [
            'button' => 'Tambah',
            'action' => route('admin.cetak.badan_add_action'),
            'id_sk_badan' => '',
            'tahun_pengelolaan' => $tahun,
            'id_pengelola_badan' => '',
            'jenis_lokasi' => '',
            'nama_lokasi' => '',
            'zona' => '',
            'no_sk' => '',
            'hari_sk' => '',
            'tgl_sk' => date('Y-m-d'),
            'retribusi_perbulan' => '',
            'retribusi_pertahun' => '',
            'arr_badan' => $arr_badan,
        ]);
    }

    public function badan_add_action(Request $request)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
            'id_pengelola_badan' => 'required',
            'jenis_lokasi' => 'required',
            'nama_lokasi' => 'required',
            'zona' => 'required',
            'no_sk' => 'required',
            'hari_sk' => 'required',
            'tgl_sk' => 'required|date',
            'retribusi_perbulan' => 'required|numeric',
            'retribusi_pertahun' => 'required|numeric',
        ]);

        DB::table('sk_badan')->insert([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'id_pengelola_badan' => $request->input('id_pengelola_badan'),
            'jenis_lokasi' => $request->input('jenis_lokasi'),
            'nama_lokasi' => $request->input('nama_lokasi'),
            'zona' => $request->input('zona'),
            'no_sk' => $request->input('no_sk'),
            'hari_sk' => $request->input('hari_sk'),
            'tgl_sk' => $request->input('tgl_sk'),
            'retribusi_perbulan' => $request->input('retribusi_perbulan'),
            'retribusi_pertahun' => $request->input('retribusi_pertahun'),
            'printed' => 0,
        ]);

        return redirect()->route('admin.cetak.badan')->with('message', 'Data SK Badan berhasil disimpan');
    }

    public function badan_update($id)
    {
        $row = DB::table('sk_badan')->where('id_sk_badan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.cetak.badan')->with('message', 'Data tidak ditemukan');
        }

        $arr_badan = DB::table('pengelola_badan as pb')
            ->select('pb.id_pengelola_badan', 'pb.nama_badan', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->where('pb.verifikasi', 1)
            ->get();

        return view('admin.cetak.badan_form', [
            'button' => 'Simpan',
            'action' => route('admin.cetak.badan_update_action', $id),
            'id_sk_badan' => $row->id_sk_badan,
            'tahun_pengelolaan' => old('tahun_pengelolaan', $row->tahun_pengelolaan),
            'id_pengelola_badan' => old('id_pengelola_badan', $row->id_pengelola_badan),
            'jenis_lokasi' => old('jenis_lokasi', $row->jenis_lokasi),
            'nama_lokasi' => old('nama_lokasi', $row->nama_lokasi),
            'zona' => old('zona', $row->zona),
            'no_sk' => old('no_sk', $row->no_sk),
            'hari_sk' => old('hari_sk', $row->hari_sk),
            'tgl_sk' => old('tgl_sk', $row->tgl_sk),
            'retribusi_perbulan' => old('retribusi_perbulan', $row->retribusi_perbulan),
            'retribusi_pertahun' => old('retribusi_pertahun', $row->retribusi_pertahun),
            'arr_badan' => $arr_badan,
        ]);
    }

    public function badan_update_action(Request $request, $id)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
            'id_pengelola_badan' => 'required',
            'jenis_lokasi' => 'required',
            'nama_lokasi' => 'required',
            'zona' => 'required',
            'no_sk' => 'required',
            'hari_sk' => 'required',
            'tgl_sk' => 'required|date',
            'retribusi_perbulan' => 'required|numeric',
            'retribusi_pertahun' => 'required|numeric',
        ]);

        DB::table('sk_badan')->where('id_sk_badan', $id)->update([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'id_pengelola_badan' => $request->input('id_pengelola_badan'),
            'jenis_lokasi' => $request->input('jenis_lokasi'),
            'nama_lokasi' => $request->input('nama_lokasi'),
            'zona' => $request->input('zona'),
            'no_sk' => $request->input('no_sk'),
            'hari_sk' => $request->input('hari_sk'),
            'tgl_sk' => $request->input('tgl_sk'),
            'retribusi_perbulan' => $request->input('retribusi_perbulan'),
            'retribusi_pertahun' => $request->input('retribusi_pertahun'),
        ]);

        return redirect()->route('admin.cetak.badan')->with('message', 'Data SK Badan berhasil diupdate');
    }

    public function badan_delete($id)
    {
        DB::table('sk_badan')->where('id_sk_badan', $id)->delete();
        return redirect()->route('admin.cetak.badan')->with('message', 'Data berhasil dihapus');
    }

    public function perorangan_cetak($id)
    {
        $row = DB::table('sk_perorangan as sp')
            ->select('sp.*', 'pp.nama', 'pp.nik', 'pp.domisili_alamat', 'pp.domisili_rt', 'pp.domisili_rw', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_perorangan as pp', 'pp.id_pengelola_perorangan', '=', 'sp.id_pengelola_perorangan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.domisili_id_kecamatan')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.domisili_id_kabupaten')
            ->where('id_sk_perorangan', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.cetak.perorangan')->with('message', 'Data tidak ditemukan');
        }

        $tahun_active = DB::table('tahun_pengelolaan')->where('actived', 1)->first();
        $tahun = $tahun_active ? $tahun_active->tahun_pengelolaan : date('Y');

        $row2 = DB::table('pejabat')
            ->where('tahun_pengelolaan', $tahun)
            ->orderBy('actived', 'DESC')
            ->orderBy('id_pejabat', 'DESC')
            ->first();

        if (!$row2) {
            $row2 = DB::table('pejabat')
                ->where('actived', 1)
                ->orderBy('id_pejabat', 'DESC')
                ->first();
        }

        if (!$row2) {
            $row2 = DB::table('pejabat')
                ->orderBy('id_pejabat', 'DESC')
                ->first();
        }

        DB::table('sk_perorangan')->where('id_sk_perorangan', $id)->update(['printed' => 1]);

        return view('admin.cetak.perorangan_sk', compact('row', 'row2'));
    }

    public function badan_cetak($id)
    {
        $row = DB::table('sk_badan as sb')
            ->select('sb.*', 'pb.nama_badan', 'pb.npwp', 'pb.pengurus_nama', 'pb.pengurus_jabatan', 'pb.alamat_kantor', 'pb.rt', 'pb.rw', 'wd.nama as desa', 'wc.nama as kec', 'wk.nama as kab')
            ->join('pengelola_badan as pb', 'pb.id_pengelola_badan', '=', 'sb.id_pengelola_badan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pb.id_kecamatan')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pb.id_kabupaten')
            ->where('id_sk_badan', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.cetak.badan')->with('message', 'Data tidak ditemukan');
        }

        $tahun_active = DB::table('tahun_pengelolaan')->where('actived', 1)->first();
        $tahun = $tahun_active ? $tahun_active->tahun_pengelolaan : date('Y');

        $row2 = DB::table('pejabat')
            ->where('tahun_pengelolaan', $tahun)
            ->orderBy('actived', 'DESC')
            ->orderBy('id_pejabat', 'DESC')
            ->first();

        if (!$row2) {
            $row2 = DB::table('pejabat')
                ->where('actived', 1)
                ->orderBy('id_pejabat', 'DESC')
                ->first();
        }

        if (!$row2) {
            $row2 = DB::table('pejabat')
                ->orderBy('id_pejabat', 'DESC')
                ->first();
        }

        DB::table('sk_badan')->where('id_sk_badan', $id)->update(['printed' => 1]);

        return view('admin.cetak.badan_sk', compact('row', 'row2'));
    }
}
