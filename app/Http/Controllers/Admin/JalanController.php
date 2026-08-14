<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JalanController extends Controller
{
    public function index()
    {
        $res = DB::table('ruas_jalan')->get();
        return view('admin.jalan.index', compact('res'));
    }

    public function read($id)
    {
        $row = DB::table('ruas_jalan')->where('id_ruas_jalan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.jalan.index')->with('message', 'Data tidak ditemukan');
        }
        return view('admin.jalan.read', compact('row'));
    }

    public function add()
    {
        return view('admin.jalan.form', [
            'button' => 'Tambah',
            'action' => route('admin.jalan.add_action'),
            'id_ruas_jalan' => old('id_ruas_jalan'),
            'status_ruas' => old('status_ruas'),
            'nomor_ruas' => old('nomor_ruas'),
            'nama_ruas' => old('nama_ruas'),
            'panjang' => old('panjang'),
            'lebar' => old('lebar'),
            'luas' => old('luas'),
            'titik_awal' => old('titik_awal'),
            'titik_akhir' => old('titik_akhir'),
            'from_lat' => old('from_lat'),
            'from_lng' => old('from_lng'),
            'to_lat' => old('to_lat'),
            'to_lng' => old('to_lng'),
        ]);
    }

    public function add_action(Request $request)
    {
        $request->validate([
            'nama_ruas' => 'required|string',
        ]);

        $data = $request->except(['_token', 'id_ruas_jalan']);
        DB::table('ruas_jalan')->insert($data);

        return redirect()->route('admin.jalan.index')->with('message', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $row = DB::table('ruas_jalan')->where('id_ruas_jalan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.jalan.index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.jalan.form', [
            'button' => 'Simpan',
            'action' => route('admin.jalan.update_action', $id),
            'id_ruas_jalan' => old('id_ruas_jalan', $row->id_ruas_jalan),
            'status_ruas' => old('status_ruas', $row->status_ruas),
            'nomor_ruas' => old('nomor_ruas', $row->nomor_ruas),
            'nama_ruas' => old('nama_ruas', $row->nama_ruas),
            'panjang' => old('panjang', $row->panjang),
            'lebar' => old('lebar', $row->lebar),
            'luas' => old('luas', $row->luas),
            'titik_awal' => old('titik_awal', $row->titik_awal),
            'titik_akhir' => old('titik_akhir', $row->titik_akhir),
            'from_lat' => old('from_lat', $row->from_lat),
            'from_lng' => old('from_lng', $row->from_lng),
            'to_lat' => old('to_lat', $row->to_lat),
            'to_lng' => old('to_lng', $row->to_lng),
        ]);
    }

    public function update_action(Request $request, $id)
    {
        $request->validate([
            'nama_ruas' => 'required|string',
        ]);

        $data = $request->except(['_token', 'id_ruas_jalan', '_method']);
        DB::table('ruas_jalan')->where('id_ruas_jalan', $id)->update($data);

        return redirect()->route('admin.jalan.index')->with('message', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $affected = DB::table('ruas_jalan')->where('id_ruas_jalan', $id)->delete();
        if ($affected) {
            return redirect()->route('admin.jalan.index')->with('message', 'Data berhasil dihapus');
        }
        return redirect()->route('admin.jalan.index')->with('message', 'Data tidak ditemukan');
    }

    public function peta($id)
    {
        $row = DB::table('ruas_jalan')->where('id_ruas_jalan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.jalan.index')->with('message', 'Data tidak ditemukan');
        }
        return view('admin.jalan.peta', compact('row'));
    }
}
