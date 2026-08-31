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

    public function add()
    {
        $kecamatan = DB::table('wilayah_kecamatan')->where('kabupaten_id', '3304')->orderBy('nama')->get();
        $ruas_jalan = DB::table('ruas_jalan')->orderBy('nama_ruas')->get();

        return view('admin.titik.form', [
            'button' => 'Tambah',
            'action' => route('admin.titik.add_action'),
            'id_titik_parkir' => old('id_titik_parkir'),
            'jenis_fasilitas' => old('jenis_fasilitas', 'luar'),
            'jenis_parkir_luar' => old('jenis_parkir_luar', 'tpk'),
            'nama_lokasi' => old('nama_lokasi'),
            'panjang_lokasi' => old('panjang_lokasi'),
            'lebar_lokasi' => old('lebar_lokasi'),
            'luas_lokasi' => old('luas_lokasi'),
            'srp_motor' => old('srp_motor'),
            'srp_mobil' => old('srp_mobil'),
            'id_kecamatan' => old('id_kecamatan'),
            'id_desa' => old('id_desa'),
            'jenis_desa' => old('jenis_desa', 'Desa'),
            'id_ruas_jalan' => old('id_ruas_jalan'),
            'titik_lat' => old('titik_lat'),
            'titik_lng' => old('titik_lng'),
            'foto_lokasi' => old('foto_lokasi'),
            'kecamatan' => $kecamatan,
            'ruas_jalan' => $ruas_jalan,
        ]);
    }

    public function add_action(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
        ]);

        $data = $request->except(['_token', 'id_titik_parkir', 'foto_lokasi']);
        $data['update_time'] = now();
        $data['update_user'] = session('admin_id', 'admin');

        if ($request->hasFile('foto_lokasi')) {
            $file = $request->file('foto_lokasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/titik_parkir'), $filename);
            $data['foto_lokasi'] = 'uploads/titik_parkir/' . $filename;
        }

        DB::table('titik_parkir')->insert($data);

        return redirect()->route('admin.titik.index')->with('message', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $row = DB::table('titik_parkir')->where('id_titik_parkir', $id)->first();
        if (!$row) {
            return redirect()->route('admin.titik.index')->with('message', 'Data tidak ditemukan');
        }

        $kecamatan = DB::table('wilayah_kecamatan')->where('kabupaten_id', '3304')->orderBy('nama')->get();
        $ruas_jalan = DB::table('ruas_jalan')->orderBy('nama_ruas')->get();

        return view('admin.titik.form', [
            'button' => 'Simpan',
            'action' => route('admin.titik.update_action', $id),
            'id_titik_parkir' => old('id_titik_parkir', $row->id_titik_parkir),
            'jenis_fasilitas' => old('jenis_fasilitas', $row->jenis_fasilitas),
            'jenis_parkir_luar' => old('jenis_parkir_luar', $row->jenis_parkir_luar),
            'nama_lokasi' => old('nama_lokasi', $row->nama_lokasi),
            'panjang_lokasi' => old('panjang_lokasi', $row->panjang_lokasi),
            'lebar_lokasi' => old('lebar_lokasi', $row->lebar_lokasi),
            'luas_lokasi' => old('luas_lokasi', $row->luas_lokasi),
            'srp_motor' => old('srp_motor', $row->srp_motor),
            'srp_mobil' => old('srp_mobil', $row->srp_mobil),
            'id_kecamatan' => old('id_kecamatan', $row->id_kecamatan),
            'id_desa' => old('id_desa', $row->id_desa),
            'jenis_desa' => old('jenis_desa', $row->jenis_desa),
            'id_ruas_jalan' => old('id_ruas_jalan', $row->id_ruas_jalan),
            'titik_lat' => old('titik_lat', $row->titik_lat),
            'titik_lng' => old('titik_lng', $row->titik_lng),
            'foto_lokasi' => old('foto_lokasi', $row->foto_lokasi),
            'kecamatan' => $kecamatan,
            'ruas_jalan' => $ruas_jalan,
        ]);
    }

    public function update_action(Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required|string',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
        ]);

        $data = $request->except(['_token', 'id_titik_parkir', 'foto_lokasi', '_method']);
        $data['update_time'] = now();
        $data['update_user'] = session('admin_id', 'admin');

        if ($request->hasFile('foto_lokasi')) {
            $file = $request->file('foto_lokasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/titik_parkir'), $filename);
            $data['foto_lokasi'] = 'uploads/titik_parkir/' . $filename;
        }

        DB::table('titik_parkir')->where('id_titik_parkir', $id)->update($data);

        return redirect()->route('admin.titik.index')->with('message', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $affected = DB::table('titik_parkir')->where('id_titik_parkir', $id)->delete();
        if ($affected) {
            return redirect()->route('admin.titik.index')->with('message', 'Data berhasil dihapus');
        }
        return redirect()->route('admin.titik.index')->with('message', 'Data tidak ditemukan');
    }

    public function desa_json($id_kecamatan)
    {
        $desa = DB::table('wilayah_desa')
            ->where('kecamatan_id', $id_kecamatan)
            ->orderBy('nama')
            ->get(['id', 'nama']);
        return response()->json($desa);
    }
}
