<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $res = DB::table('users')->where('level', 'admin')->get();
        return view('admin.users.index', compact('res'));
    }

    public function read($id)
    {
        $row = DB::table('users')->where('id_users', $id)->first();
        if (!$row) {
            return redirect()->route('admin.users.index')->with('message', 'Data tidak ditemukan');
        }
        return view('admin.users.read', compact('row'));
    }

    public function add()
    {
        return view('admin.users.form', [
            'button' => 'Tambah',
            'action' => route('admin.users.add_action'),
            'id_users' => '',
            'username' => '',
            'email' => '',
            'nama' => '',
            'password' => '',
        ]);
    }

    public function add_action(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'required|min:5',
            'passwordconf' => 'required|same:password',
        ]);

        DB::table('users')->insert([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
            'password' => md5($request->input('password')),
            'level' => 'admin',
            'actived' => 1,
        ]);

        return redirect()->route('admin.users.index')->with('message', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $row = DB::table('users')->where('id_users', $id)->first();
        if (!$row) {
            return redirect()->route('admin.users.index')->with('message', 'Data tidak ditemukan');
        }

        return view('admin.users.form', [
            'button' => 'Simpan',
            'action' => route('admin.users.update_action', $id),
            'id_users' => $row->id_users,
            'username' => old('username', $row->username),
            'email' => old('email', $row->email),
            'nama' => old('nama', $row->nama),
            'password' => '',
        ]);
    }

    public function update_action(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $id . ',id_users',
            'email' => 'required|email',
            'nama' => 'required',
        ]);

        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:5',
                'passwordconf' => 'same:password',
            ]);
            $data['password'] = md5($request->input('password'));
        }

        DB::table('users')->where('id_users', $id)->update($data);

        return redirect()->route('admin.users.index')->with('message', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        DB::table('users')->where('id_users', $id)->delete();
        return redirect()->route('admin.users.index')->with('message', 'Data berhasil dihapus');
    }

    public function reset($id)
    {
        DB::table('users')->where('id_users', $id)->update([
            'password' => md5('password')
        ]);
        return redirect()->route('admin.users.index')->with('message', 'Password berhasil direset menjadi: password');
    }
}
