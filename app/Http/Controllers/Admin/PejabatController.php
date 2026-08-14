<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PejabatController extends Controller
{
    public function index()
    {
        $res = DB::table('pejabat')->orderBy('id_pejabat', 'DESC')->get();
        return view('admin.pejabat.index', compact('res'));
    }

    public function read($id)
    {
        $row = DB::table('pejabat')->where('id_pejabat', $id)->first();
        if (!$row) {
            return redirect()->route('admin.pejabat.index')->with('message', 'Data tidak ditemukan');
        }
        return view('admin.pejabat.read', compact('row'));
    }

    public function add(Request $request)
    {
        return view('admin.pejabat.form', [
            'button' => 'Tambah',
            'action' => route('admin.pejabat.add_action'),
            'id_pejabat' => '',
            'tahun_pengelolaan' => $request->session()->get('tahun', date('Y')),
            'nama_pejabat' => '',
            'nip_pejabat' => '',
            'pangkat_pejabat' => '',
        ]);
    }

    public function add_action(Request $request)
    {
        $request->validate([
            'nama_pejabat' => 'required',
        ]);

        DB::table('pejabat')->insert([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'nama_pejabat' => $request->input('nama_pejabat'),
            'nip_pejabat' => $request->input('nip_pejabat'),
            'pangkat_pejabat' => $request->input('pangkat_pejabat'),
            'actived' => 1,
        ]);

        return redirect()->route('admin.pejabat.index')->with('message', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $row = DB::table('pejabat')->where('id_pejabat', $id)->first();
        if (!$row) {
            return redirect()->route('admin.pejabat.index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.pejabat.form', [
            'button' => 'Simpan',
            'action' => route('admin.pejabat.update_action', $id),
            'id_pejabat' => $row->id_pejabat,
            'tahun_pengelolaan' => old('tahun_pengelolaan', $row->tahun_pengelolaan),
            'nama_pejabat' => old('nama_pejabat', $row->nama_pejabat),
            'nip_pejabat' => old('nip_pejabat', $row->nip_pejabat),
            'pangkat_pejabat' => old('pangkat_pejabat', $row->pangkat_pejabat),
        ]);
    }

    public function update_action(Request $request, $id)
    {
        $request->validate([
            'nama_pejabat' => 'required',
        ]);

        DB::table('pejabat')->where('id_pejabat', $id)->update([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'nama_pejabat' => $request->input('nama_pejabat'),
            'nip_pejabat' => $request->input('nip_pejabat'),
            'pangkat_pejabat' => $request->input('pangkat_pejabat'),
        ]);

        return redirect()->route('admin.pejabat.index')->with('message', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        DB::table('pejabat')->where('id_pejabat', $id)->delete();
        return redirect()->route('admin.pejabat.index')->with('message', 'Data berhasil dihapus');
    }

    public function active($id)
    {
        DB::table('pejabat')->update(['actived' => 0]);
        DB::table('pejabat')->where('id_pejabat', $id)->update(['actived' => 1]);
        return redirect()->route('admin.pejabat.index')->with('message', 'Pejabat berhasil diaktifkan');
    }

    public function unactive($id)
    {
        DB::table('pejabat')->where('id_pejabat', $id)->update(['actived' => 0]);
        return redirect()->route('admin.pejabat.index')->with('message', 'Pejabat berhasil dinonaktifkan');
    }
}
