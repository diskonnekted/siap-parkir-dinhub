<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TitikjukirController extends Controller
{
    public function index()
    {
        $res = DB::table('titik_jukir as tj')
            ->select('tj.*', 'tp.nama_lokasi', 'jp.nama', 'rj.nama_ruas', 'wc.nama as kec', 'wd.nama as desa')
            ->leftJoin('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->leftJoin('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->orderBy('id_titik_jukir', 'DESC')
            ->get();

        return view('admin.titikjukir.index', compact('res'));
    }

    public function read($id)
    {
        $row = DB::table('titik_jukir as tj')
            ->select('tj.*', 'tp.*', 'rj.*', 'jp.*', 'wc.nama as kec', 'wd.nama as desa')
            ->join('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->join('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->join('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->where('id_titik_jukir', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.titikjukir.index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.titikjukir.read', compact('row'));
    }

    public function add()
    {
        $tahun_active = DB::table('tahun_pengelolaan')->where('actived', 1)->first();
        $tahun = $tahun_active ? $tahun_active->tahun_pengelolaan : date('Y');

        $arr_titik = DB::table('titik_parkir')->get();

        $arr_jukir = DB::table('juru_parkir as jp')
            ->select('jp.*', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'jp.domisili_id_desa')
            ->where('jp.verifikasi', 1)
            ->get();

        return view('admin.titikjukir.form', [
            'button' => 'Tambah',
            'action' => route('admin.titikjukir.add_action'),
            'id_titik_jukir' => '',
            'tahun_pengelolaan' => $tahun,
            'id_titik_parkir' => '',
            'id_juru_parkir' => '',
            'jam_kerja_awal' => '',
            'jam_kerja_akhir' => '',
            'arr_titik' => $arr_titik,
            'arr_jukir' => $arr_jukir,
        ]);
    }

    public function add_action(Request $request)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
            'id_titik_parkir' => 'required',
            'id_juru_parkir' => 'required',
            'jam_kerja_awal' => 'nullable',
            'jam_kerja_akhir' => 'nullable',
        ]);

        DB::table('titik_jukir')->insert([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'id_titik_parkir' => $request->input('id_titik_parkir'),
            'id_juru_parkir' => $request->input('id_juru_parkir'),
            'jam_kerja_awal' => $request->input('jam_kerja_awal'),
            'jam_kerja_akhir' => $request->input('jam_kerja_akhir'),
            'actived' => 1,
        ]);

        return redirect()->route('admin.titikjukir.index')->with('message', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $row = DB::table('titik_jukir')->where('id_titik_jukir', $id)->first();
        if (!$row) {
            return redirect()->route('admin.titikjukir.index')->with('message', 'Data tidak ditemukan');
        }

        $arr_titik = DB::table('titik_parkir')->get();

        $arr_jukir = DB::table('juru_parkir as jp')
            ->select('jp.*', 'wd.nama as desa')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'jp.domisili_id_desa')
            ->where('jp.verifikasi', 1)
            ->get();

        return view('admin.titikjukir.form', [
            'button' => 'Simpan',
            'action' => route('admin.titikjukir.update_action', $id),
            'id_titik_jukir' => $row->id_titik_jukir,
            'tahun_pengelolaan' => old('tahun_pengelolaan', $row->tahun_pengelolaan),
            'id_titik_parkir' => old('id_titik_parkir', $row->id_titik_parkir),
            'id_juru_parkir' => old('id_juru_parkir', $row->id_juru_parkir),
            'jam_kerja_awal' => old('jam_kerja_awal', $row->jam_kerja_awal),
            'jam_kerja_akhir' => old('jam_kerja_akhir', $row->jam_kerja_akhir),
            'arr_titik' => $arr_titik,
            'arr_jukir' => $arr_jukir,
        ]);
    }

    public function update_action(Request $request, $id)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
            'id_titik_parkir' => 'required',
            'id_juru_parkir' => 'required',
            'jam_kerja_awal' => 'nullable',
            'jam_kerja_akhir' => 'nullable',
        ]);

        DB::table('titik_jukir')->where('id_titik_jukir', $id)->update([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'id_titik_parkir' => $request->input('id_titik_parkir'),
            'id_juru_parkir' => $request->input('id_juru_parkir'),
            'jam_kerja_awal' => $request->input('jam_kerja_awal'),
            'jam_kerja_akhir' => $request->input('jam_kerja_akhir'),
        ]);

        return redirect()->route('admin.titikjukir.index')->with('message', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        DB::table('titik_jukir')->where('id_titik_jukir', $id)->delete();
        return redirect()->route('admin.titikjukir.index')->with('message', 'Data berhasil dihapus');
    }

    public function kta($id)
    {
        $row = DB::table('titik_jukir as tj')
            ->select('tj.*', 'tp.*', 'rj.*', 'jp.*', 'wk.nama as kab', 'wc.nama as kec', 'wd.nama as desa')
            ->join('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->join('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->join('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->join('wilayah_kabupaten as wk', 'wk.id', '=', 'jp.domisili_id_kabupaten')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'jp.domisili_id_kecamatan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'jp.domisili_id_desa')
            ->where('id_titik_jukir', $id)
            ->first();

        if (!$row) {
            abort(404, 'Data tidak ditemukan');
        }

        return view('admin.titikjukir.kta', compact('row'));
    }

    public function spt($id)
    {
        $row = DB::table('titik_jukir as tj')
            ->select('tj.*', 'tp.*', 'rj.*', 'jp.*', 'wc.nama as kec', 'wd.nama as desa')
            ->join('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->join('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->join('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->where('id_titik_jukir', $id)
            ->first();

        if (!$row) {
            return redirect()->route('admin.titikjukir.index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.titikjukir.spt', [
            'button' => 'Cetak',
            'action' => route('admin.titikjukir.spt_action'),
            'id_titik_jukir' => $row->id_titik_jukir,
            'no_spt' => old('no_spt', $row->no_spt),
            'tmt_spt_awal' => old('tmt_spt_awal', $row->tmt_spt_awal),
            'tmt_spt_akhir' => old('tmt_spt_akhir', $row->tmt_spt_akhir),
            'tgl_spt' => old('tgl_spt', $row->tgl_spt),
            'setoran_perbulan' => old('setoran_perbulan', $row->setoran_perbulan),
            'titik_lat' => $row->titik_lat,
            'titik_lng' => $row->titik_lng,
            'from_lat' => $row->from_lat,
            'from_lng' => $row->from_lng,
            'to_lat' => $row->to_lat,
            'to_lng' => $row->to_lng,
            'nama_lokasi' => $row->nama_lokasi,
        ]);
    }

    public function spt_action(Request $request)
    {
        $id = $request->input('id_titik_jukir');
        $request->validate([
            'no_spt' => 'required',
            'tmt_spt_awal' => 'required|date',
            'tmt_spt_akhir' => 'required|date',
            'tgl_spt' => 'required|date',
            'setoran_perbulan' => 'required|numeric',
        ]);

        DB::table('titik_jukir')->where('id_titik_jukir', $id)->update([
            'no_spt' => $request->input('no_spt'),
            'tmt_spt_awal' => $request->input('tmt_spt_awal'),
            'tmt_spt_akhir' => $request->input('tmt_spt_akhir'),
            'tgl_spt' => $request->input('tgl_spt'),
            'setoran_perbulan' => $request->input('setoran_perbulan'),
        ]);

        return redirect()->route('admin.titikjukir.sptcetak', $id);
    }

    public function sptcetak($id)
    {
        $row = DB::table('titik_jukir as tj')
            ->select('tj.*', 'tp.*', 'rj.*', 'jp.*', 'wc.nama as kec', 'wd.nama as desa')
            ->join('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->join('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->join('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->join('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->join('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->where('id_titik_jukir', $id)
            ->first();

        if (!$row) {
            abort(404, 'Data tidak ditemukan');
        }

        $row1 = DB::table('titik_parkir as tp')
            ->select('tp.*', 'rj.nama_ruas', 'wd.nama as desa', 'wc.nama as kec')
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->where('id_titik_parkir', $row->id_titik_parkir)
            ->first();

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

        return view('admin.titikjukir.sptcetak', compact('row', 'row1', 'row2'));
    }

    public function titik_json($id)
    {
        $row = DB::table('titik_parkir as tp')
            ->select('tp.*', 'rj.nama_ruas')
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->where('id_titik_parkir', $id)
            ->first();

        if (!$row) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'id_titik_parkir' => $row->id_titik_parkir,
            'nama_lokasi' => $row->nama_lokasi,
            'titik_lat' => $row->titik_lat,
            'titik_lng' => $row->titik_lng,
            'from_lat' => $row->from_lat,
            'from_lng' => $row->from_lng,
            'to_lat' => $row->to_lat,
            'to_lng' => $row->to_lng,
        ]);
    }
}
