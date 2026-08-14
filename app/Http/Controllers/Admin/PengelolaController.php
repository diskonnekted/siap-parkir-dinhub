<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengelolaController extends Controller
{
    public function perorangan()
    {
        $res = DB::table('pengelola_perorangan as pp')
            ->select('pp.*', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->get();

        return view('admin.pengelola.perorangan', compact('res'));
    }

    public function detail_perorangan($id)
    {
        $row1 = DB::table('pengelola_perorangan as pp')
            ->select('pp.*', 'wp.nama as prov', 'wk.nama as kab', 'wc.nama as kec', 'wd.nama as desa')
            ->leftJoin('wilayah_provinsi as wp', 'wp.id', '=', 'pp.id_provinsi')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.id_kabupaten')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.id_desa')
            ->where('id_pengelola_perorangan', $id)
            ->first();

        $row2 = DB::table('pengelola_perorangan as pp')
            ->select('pp.*', 'wp.nama as prov', 'wk.nama as kab', 'wc.nama as kec', 'wd.nama as desa')
            ->leftJoin('wilayah_provinsi as wp', 'wp.id', '=', 'pp.domisili_id_provinsi')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.domisili_id_kabupaten')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.domisili_id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->where('id_pengelola_perorangan', $id)
            ->first();

        return view('admin.pengelola.perorangan_detail', compact('row1', 'row2'));
    }

    public function verifikasi_perorangan($id)
    {
        DB::table('pengelola_perorangan')
            ->where('id_pengelola_perorangan', $id)
            ->update(['verifikasi' => 1]);

        return redirect()->route('admin.pengelola.perorangan')->with('message', 'Data berhasil diverifikasi');
    }

    public function unverifikasi_perorangan($id)
    {
        DB::table('pengelola_perorangan')
            ->where('id_pengelola_perorangan', $id)
            ->update(['verifikasi' => 0]);

        return redirect()->route('admin.pengelola.perorangan')->with('message', 'Verifikasi berhasil dibatalkan');
    }

    public function badan()
    {
        $res = DB::table('pengelola_badan as pb')
            ->select('pb.*', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->get();

        return view('admin.pengelola.badan', compact('res'));
    }

    public function detail_badan($id)
    {
        $row = DB::table('pengelola_badan as pb')
            ->select('pb.*', 'wp.nama as prov', 'wk.nama as kab', 'wc.nama as kec', 'wd.nama as desa')
            ->leftJoin('wilayah_provinsi as wp', 'wp.id', '=', 'pb.id_provinsi')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pb.id_kabupaten')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pb.id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pb.id_desa')
            ->where('id_pengelola_badan', $id)
            ->first();

        return view('admin.pengelola.badan_detail', compact('row'));
    }

    public function verifikasi_badan($id)
    {
        DB::table('pengelola_badan')
            ->where('id_pengelola_badan', $id)
            ->update(['verifikasi' => 1]);

        return redirect()->route('admin.pengelola.badan')->with('message', 'Data berhasil diverifikasi');
    }

    public function unverifikasi_badan($id)
    {
        DB::table('pengelola_badan')
            ->where('id_pengelola_badan', $id)
            ->update(['verifikasi' => 0]);

        return redirect()->route('admin.pengelola.badan')->with('message', 'Verifikasi berhasil dibatalkan');
    }

    public function jukir()
    {
        $res = DB::table('juru_parkir as pp')
            ->select('pp.*', 'pb.nama_badan', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->leftJoin('pengelola_badan as pb', 'pb.id_users', '=', 'pp.id_users')
            ->get();

        return view('admin.pengelola.jukir', compact('res'));
    }

    public function detail_jukir($id)
    {
        $row1 = DB::table('juru_parkir as pp')
            ->select('pp.*', 'pb.nama_badan', 'wp.nama as prov', 'wk.nama as kab', 'wc.nama as kec', 'wd.nama as desa')
            ->leftJoin('pengelola_badan as pb', 'pb.id_users', '=', 'pp.id_users')
            ->leftJoin('wilayah_provinsi as wp', 'wp.id', '=', 'pp.id_provinsi')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.id_kabupaten')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.id_desa')
            ->where('id_juru_parkir', $id)
            ->first();

        $row2 = DB::table('juru_parkir as pp')
            ->select('pp.*', 'wp.nama as prov', 'wk.nama as kab', 'wc.nama as kec', 'wd.nama as desa')
            ->leftJoin('wilayah_provinsi as wp', 'wp.id', '=', 'pp.domisili_id_provinsi')
            ->leftJoin('wilayah_kabupaten as wk', 'wk.id', '=', 'pp.domisili_id_kabupaten')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'pp.domisili_id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'pp.domisili_id_desa')
            ->where('id_juru_parkir', $id)
            ->first();

        return view('admin.pengelola.jukir_detail', compact('row1', 'row2'));
    }

    public function verifikasi_jukir($id)
    {
        DB::table('juru_parkir')
            ->where('id_juru_parkir', $id)
            ->update(['verifikasi' => 1]);

        return redirect()->route('admin.pengelola.jukir')->with('message', 'Data berhasil diverifikasi');
    }

    public function unverifikasi_jukir($id)
    {
        DB::table('juru_parkir')
            ->where('id_juru_parkir', $id)
            ->update(['verifikasi' => 0]);

        return redirect()->route('admin.pengelola.jukir')->with('message', 'Verifikasi berhasil dibatalkan');
    }

    public function update_jukir($id)
    {
        $row = DB::table('juru_parkir')->where('id_juru_parkir', $id)->first();
        if (!$row) {
            return redirect()->route('admin.pengelola.jukir')->with('message', 'Data tidak ditemukan');
        }

        $arr_jk = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        $arr_agama = [
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Budha' => 'Budha',
            'Konghucu' => 'Konghucu'
        ];
        $arr_wn = ['WNI' => 'Warga Negara Indonesia', 'WNA' => 'Warga Negara Asing'];

        $arr_prov = DB::table('wilayah_provinsi')->pluck('nama', 'id')->toArray();
        $arr_kab = DB::table('wilayah_kabupaten')->where('provinsi_id', $row->id_provinsi)->pluck('nama', 'id')->toArray();
        if (empty($arr_kab)) {
            $arr_kab = DB::table('wilayah_kabupaten')->where('provinsi_id', '33')->pluck('nama', 'id')->toArray(); // fallback to Jateng
        }
        $arr_kec = DB::table('wilayah_kecamatan')->where('kabupaten_id', $row->id_kabupaten)->pluck('nama', 'id')->toArray();
        if (empty($arr_kec)) {
            $arr_kec = DB::table('wilayah_kecamatan')->where('kabupaten_id', '3304')->pluck('nama', 'id')->toArray(); // fallback to Banjarnegara
        }
        $arr_desa = DB::table('wilayah_desa')->where('kecamatan_id', $row->id_kecamatan)->pluck('nama', 'id')->toArray();

        return view('admin.pengelola.jukir_form', [
            'button' => 'Simpan',
            'action' => route('admin.pengelola.update_jukir_action', $id),
            'id_juru_parkir' => $row->id_juru_parkir,
            'nama' => old('nama', $row->nama),
            'nik' => old('nik', $row->nik),
            'tempat_lahir' => old('tempat_lahir', $row->tempat_lahir),
            'tanggal_lahir' => old('tanggal_lahir', $row->tanggal_lahir),
            'jk' => old('jk', $row->jk),
            'agama' => old('agama', $row->agama),
            'kewarganegaraan' => old('kewarganegaraan', $row->kewarganegaraan),
            'id_provinsi' => old('id_provinsi', $row->id_provinsi),
            'id_kabupaten' => old('id_kabupaten', $row->id_kabupaten),
            'id_kecamatan' => old('id_kecamatan', $row->id_kecamatan),
            'id_desa' => old('id_desa', $row->id_desa),
            'alamat' => old('alamat', $row->alamat),
            'rt' => old('rt', $row->rt),
            'rw' => old('rw', $row->rw),
            'domisili_id_provinsi' => old('domisili_id_provinsi', $row->domisili_id_provinsi),
            'domisili_id_kabupaten' => old('domisili_id_kabupaten', $row->domisili_id_kabupaten),
            'domisili_id_kecamatan' => old('domisili_id_kecamatan', $row->domisili_id_kecamatan),
            'domisili_id_desa' => old('domisili_id_desa', $row->domisili_id_desa),
            'domisili_alamat' => old('domisili_alamat', $row->domisili_alamat),
            'domisili_rt' => old('domisili_rt', $row->domisili_rt),
            'domisili_rw' => old('domisili_rw', $row->domisili_rw),
            'no_telp' => old('no_telp', $row->no_telp),
            'foto' => $row->foto,
            'foto_ktp' => $row->foto_ktp,
            'arr_jk' => $arr_jk,
            'arr_agama' => $arr_agama,
            'arr_wn' => $arr_wn,
            'arr_prov' => $arr_prov,
            'arr_kab' => $arr_kab,
            'arr_kec' => $arr_kec,
            'arr_desa' => $arr_desa,
        ]);
    }

    public function update_jukir_action(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jk' => $request->input('jk'),
            'agama' => $request->input('agama'),
            'kewarganegaraan' => $request->input('kewarganegaraan'),
            'id_provinsi' => $request->input('id_provinsi'),
            'id_kabupaten' => $request->input('id_kabupaten'),
            'id_kecamatan' => $request->input('id_kecamatan'),
            'id_desa' => $request->input('id_desa'),
            'alamat' => $request->input('alamat'),
            'rt' => $request->input('rt'),
            'rw' => $request->input('rw'),
            'domisili_id_provinsi' => $request->input('domisili_id_provinsi'),
            'domisili_id_kabupaten' => $request->input('domisili_id_kabupaten'),
            'domisili_id_kecamatan' => $request->input('domisili_id_kecamatan'),
            'domisili_id_desa' => $request->input('domisili_id_desa'),
            'domisili_alamat' => $request->input('domisili_alamat'),
            'domisili_rt' => $request->input('domisili_rt'),
            'domisili_rw' => $request->input('domisili_rw'),
            'no_telp' => $request->input('no_telp'),
        ];

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('assets/img/jukir', 'public');
            $data['foto'] = $path;
        }

        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('assets/img/jukir', 'public');
            $data['foto_ktp'] = $path;
        }

        DB::table('juru_parkir')
            ->where('id_juru_parkir', $id)
            ->update($data);

        return redirect()->route('admin.pengelola.jukir')->with('message', 'Data berhasil diupdate');
    }
}
