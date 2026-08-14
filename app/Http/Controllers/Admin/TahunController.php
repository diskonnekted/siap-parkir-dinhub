<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunController extends Controller
{
    public function index()
    {
        $res = DB::table('tahun_pengelolaan')->orderBy('id_tahun_pengelolaan', 'DESC')->get();
        return view('admin.tahun.index', compact('res'));
    }

    public function read($id)
    {
        $row = DB::table('tahun_pengelolaan')->where('id_tahun_pengelolaan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.tahun.index')->with('message', 'Data tidak ditemukan');
        }
        return view('admin.tahun.read', compact('row'));
    }

    public function add()
    {
        return view('admin.tahun.form', [
            'button' => 'Tambah',
            'action' => route('admin.tahun.add_action'),
            'id_tahun_pengelolaan' => '',
            'tahun_pengelolaan' => '',
        ]);
    }

    public function add_action(Request $request)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
        ]);

        DB::table('tahun_pengelolaan')->insert([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
            'actived' => 1,
        ]);

        return redirect()->route('admin.tahun.index')->with('message', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $row = DB::table('tahun_pengelolaan')->where('id_tahun_pengelolaan', $id)->first();
        if (!$row) {
            return redirect()->route('admin.tahun.index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.tahun.form', [
            'button' => 'Simpan',
            'action' => route('admin.tahun.update_action', $id),
            'id_tahun_pengelolaan' => $row->id_tahun_pengelolaan,
            'tahun_pengelolaan' => old('tahun_pengelolaan', $row->tahun_pengelolaan),
        ]);
    }

    public function update_action(Request $request, $id)
    {
        $request->validate([
            'tahun_pengelolaan' => 'required',
        ]);

        DB::table('tahun_pengelolaan')->where('id_tahun_pengelolaan', $id)->update([
            'tahun_pengelolaan' => $request->input('tahun_pengelolaan'),
        ]);

        return redirect()->route('admin.tahun.index')->with('message', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        DB::table('tahun_pengelolaan')->where('id_tahun_pengelolaan', $id)->delete();
        return redirect()->route('admin.tahun.index')->with('message', 'Data berhasil dihapus');
    }

    public function active($id)
    {
        DB::table('tahun_pengelolaan')->update(['actived' => 0]);
        DB::table('tahun_pengelolaan')->where('id_tahun_pengelolaan', $id)->update(['actived' => 1]);
        return redirect()->route('admin.tahun.index')->with('message', 'Tahun berhasil diaktifkan');
    }

    public function unactive($id)
    {
        DB::table('tahun_pengelolaan')->where('id_tahun_pengelolaan', $id)->update(['actived' => 0]);
        return redirect()->route('admin.tahun.index')->with('message', 'Tahun berhasil dinonaktifkan');
    }
}
