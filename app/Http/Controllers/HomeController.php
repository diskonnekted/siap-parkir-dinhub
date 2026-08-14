<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch complaints to show on the landing page
        $pengaduan = DB::table('pengaduan')
            ->where('publish', 1)
            ->orderBy('id_pengaduan', 'DESC')
            ->limit(5)
            ->get();

        // Calculate statistics
        $stats = [
            'perorangan' => DB::table('pengelola_perorangan')->count(),
            'badan' => DB::table('pengelola_badan')->count(),
            'jukir' => DB::table('juru_parkir')->count(),
            'titik' => DB::table('titik_parkir')->count(),
            'jalan' => DB::table('ruas_jalan')->count(),
        ];

        return view('public.home', compact('pengaduan', 'stats'));
    }

    public function pengaduan_action(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string|min:16',
            'alamat' => 'required|string',
            'nohp' => 'required|string',
            'plat_nomor' => 'required|string',
            'lokasi' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        DB::table('pengaduan')->insert([
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'alamat' => $request->input('alamat'),
            'nohp' => $request->input('nohp'),
            'plat_nomor' => $request->input('plat_nomor'),
            'lokasi' => $request->input('lokasi'),
            'keterangan' => $request->input('keterangan'),
            'publish' => 0, // needs admin approval
            'respon' => 'baru',
            'post_time' => now(),
        ]);

        return redirect()->to(url('/#contact'))->with('message', 'Pengaduan berhasil dilaporkan. Terima kasih atas laporan Anda.');
    }
}
