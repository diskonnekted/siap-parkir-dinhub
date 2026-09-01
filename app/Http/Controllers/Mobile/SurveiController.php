<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveiController extends Controller
{
    /**
     * Daftar titik parkir + jukir yang ditugaskan (sumber: penugasan aktif).
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $rows = DB::table('titik_jukir as tj')
            ->select(
                'tj.id_titik_jukir',
                'tj.id_titik_parkir',
                'tj.id_juru_parkir',
                'tj.actived',
                'tj.tahun_pengelolaan',
                'tp.nama_lokasi',
                'tp.titik_lat',
                'tp.titik_lng',
                'tp.foto_lokasi',
                'jp.nama as nama_jukir',
                'jp.foto as foto_jukir',
                'jp.verifikasi',
                'rj.nama_ruas',
                'wc.nama as kec'
            )
            ->join('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->join('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('tp.nama_lokasi', 'like', "%{$q}%")
                      ->orWhere('jp.nama', 'like', "%{$q}%")
                      ->orWhere('rj.nama_ruas', 'like', "%{$q}%");
                });
            })
            ->orderBy('tj.actived', 'desc')
            ->orderBy('tp.nama_lokasi')
            ->limit(200)
            ->get();

        return view('mobile.survei.index', [
            'rows' => $rows,
            'q' => $q,
        ]);
    }

    /**
     * Detail satu penugasan (titik + jukir) untuk verifikasi & navigasi edit.
     */
    public function read($id)
    {
        $row = DB::table('titik_jukir as tj')
            ->select('tj.*', 'tp.*', 'rj.*', 'jp.*', 'tj.id_titik_jukir',
                     'wc.nama as kec', 'wd.nama as desa')
            ->join('titik_parkir as tp', 'tp.id_titik_parkir', '=', 'tj.id_titik_parkir')
            ->join('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->where('tj.id_titik_jukir', $id)
            ->first();

        if (!$row) {
            return redirect()->route('mobile.survei.index')->with('message', 'Data tidak ditemukan');
        }

        return view('mobile.survei.read', compact('row'));
    }

    /**
     * Peta seluruh titik parkir Banjarnegara (mobile).
     * Menampilkan marker tiap titik parkir beserta info ringkas & jukir aktif.
     */
    public function peta(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $kec = trim((string) $request->get('kec', ''));

        $query = DB::table('titik_parkir as tp')
            ->select(
                'tp.id_titik_parkir',
                'tp.nama_lokasi',
                'tp.titik_lat',
                'tp.titik_lng',
                'tp.jenis_fasilitas',
                'tp.jenis_parkir_luar',
                'tp.luas_lokasi',
                'tp.srp_motor',
                'tp.srp_mobil',
                'tp.foto_lokasi',
                'wc.nama as kec',
                'wd.nama as desa',
                'rj.nama_ruas'
            )
            ->leftJoin('wilayah_kecamatan as wc', 'wc.id', '=', 'tp.id_kecamatan')
            ->leftJoin('wilayah_desa as wd', 'wd.id', '=', 'tp.id_desa')
            ->leftJoin('ruas_jalan as rj', 'rj.id_ruas_jalan', '=', 'tp.id_ruas_jalan')
            ->whereNotNull('tp.titik_lat')
            ->whereNotNull('tp.titik_lng')
            ->where('tp.titik_lat', '!=', '')
            ->where('tp.titik_lng', '!=', '');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('tp.nama_lokasi', 'like', "%{$q}%")
                  ->orWhere('rj.nama_ruas', 'like', "%{$q}%")
                  ->orWhere('wd.nama', 'like', "%{$q}%");
            });
        }
        if ($kec !== '') {
            $query->where('tp.id_kecamatan', $kec);
        }

        $rows = $query->orderBy('tp.nama_lokasi')->get();

        // Ambil jukir aktif per titik (jika ada) untuk ditampilkan di popup.
        $jukirAktif = DB::table('titik_jukir as tj')
            ->select('tj.id_titik_parkir', 'jp.nama', 'jp.no_telp', 'jp.verifikasi', 'tj.id_titik_jukir')
            ->join('juru_parkir as jp', 'jp.id_juru_parkir', '=', 'tj.id_juru_parkir')
            ->where('tj.actived', 1)
            ->get()
            ->keyBy('id_titik_parkir');

        $titik = $rows->map(function ($r) use ($jukirAktif) {
            $j = $jukirAktif->get($r->id_titik_parkir);
            return [
                'id' => $r->id_titik_parkir,
                'nama' => $r->nama_lokasi,
                'lat' => (float) $r->titik_lat,
                'lng' => (float) $r->titik_lng,
                'jenis' => $r->jenis_parkir_luar ?: $r->jenis_fasilitas,
                'luas' => $r->luas_lokasi,
                'srp_motor' => $r->srp_motor,
                'srp_mobil' => $r->srp_mobil,
                'foto' => $r->foto_lokasi,
                'kec' => trim((string) $r->kec),
                'desa' => trim((string) $r->desa),
                'ruas' => trim((string) $r->nama_ruas),
                'jukir' => $j ? $j->nama : null,
                'jukir_telp' => $j ? $j->no_telp : null,
                'jukir_verif' => $j ? (int) $j->verifikasi : null,
                'id_titik_jukir' => $j ? $j->id_titik_jukir : null,
            ];
        })->values();

        // Pusat peta: rata-rata koordinat, fallback ke kantor Dinhub Banjarnegara.
        $center = ['lat' => -7.3952, 'lng' => 109.6996];
        if ($titik->count() > 0) {
            $center = [
                'lat' => round($titik->avg('lat'), 6),
                'lng' => round($titik->avg('lng'), 6),
            ];
        }

        $kecamatan = DB::table('wilayah_kecamatan')->where('kabupaten_id', '3304')->orderBy('nama')->get();

        return view('mobile.survei.peta', [
            'titik' => $titik,
            'center' => $center,
            'kecamatan' => $kecamatan,
            'q' => $q,
            'kec' => $kec,
        ]);
    }

    /**
     * Verifikasi jukir di lapangan (set flag verifikasi = 1 + catat waktu/user).
     */
    public function verifikasi_jukir($id_jukir)
    {
        $data = [
            'verifikasi' => 1,
            'verifikasi_time' => now(),
            'verifikasi_user' => session('username', 'admin'),
        ];

        // Simpan foto hasil pemotretan lapangan (jika ada) sebagai foto jukir
        if (request()->hasFile('foto')) {
            $data['foto'] = $this->saveUpload(request()->file('foto'), 'uploads/jukir');
        }

        DB::table('juru_parkir')->where('id_juru_parkir', $id_jukir)->update($data);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['ok' => true, 'message' => 'Jukir berhasil diverifikasi']);
        }
        return back()->with('message', 'Jukir berhasil diverifikasi');
    }

    /**
     * Cabut verifikasi jukir.
     */
    public function unverifikasi_jukir($id_jukir)
    {
        DB::table('juru_parkir')->where('id_juru_parkir', $id_jukir)->update([
            'verifikasi' => 0,
        ]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['ok' => true, 'message' => 'Verifikasi dicabut']);
        }
        return back()->with('message', 'Verifikasi dicabut');
    }

    // ============================================================
    //  JUKIR: tambah / edit
    // ============================================================

    public function jukir_add()
    {
        return view('mobile.survei.jukir_form', [
            'mode' => 'add',
            'action' => route('mobile.survei.jukir_save'),
            'jukir' => null,
            'kecamatan' => $this->kecamatanList(),
        ]);
    }

    public function jukir_edit($id)
    {
        $jukir = DB::table('juru_parkir')->where('id_juru_parkir', $id)->first();
        if (!$jukir) {
            return redirect()->route('mobile.survei.index')->with('message', 'Jukir tidak ditemukan');
        }

        return view('mobile.survei.jukir_form', [
            'mode' => 'edit',
            'action' => route('mobile.survei.jukir_save'),
            'jukir' => $jukir,
            'kecamatan' => $this->kecamatanList(),
        ]);
    }

    public function jukir_save(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nik' => 'required|string|max:20',
        ]);

        $id = $request->input('id_juru_parkir');

        $data = [
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jk' => $request->input('jk') ?: 'L',
            'agama' => $request->input('agama'),
            'kewarganegaraan' => $request->input('kewarganegaraan') ?: 'WNI',
            'domisili_id_kecamatan' => $request->input('domisili_id_kecamatan'),
            'domisili_id_desa' => $request->input('domisili_id_desa'),
            'domisili_alamat' => $request->input('domisili_alamat'),
            'domisili_rt' => $request->input('domisili_rt'),
            'domisili_rw' => $request->input('domisili_rw'),
            'no_telp' => $request->input('no_telp'),
            'update_time' => now(),
            'update_user' => session('username', 'admin'),
        ];

        // Upload foto jukir langsung ke public agar dapat diakses tanpa storage:link
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->saveUpload($request->file('foto'), 'uploads/jukir');
        }

        if ($id) {
            DB::table('juru_parkir')->where('id_juru_parkir', $id)->update($data);
            $msg = 'Data jukir berhasil diperbarui';
        } else {
            // Lengkapi kolom NOT NULL yang tidak boleh kosong saat insert baru.
            // Alamat KTP disamakan dengan domisili bila tidak diisi terpisah.
            $data['id_users'] = session('id_users', 0);
            $data['no_juru_parkir'] = $this->nextNoJukir();
            $data['tanggal_lahir'] = $data['tanggal_lahir'] ?: '1970-01-01';
            $data['tempat_lahir'] = $data['tempat_lahir'] ?: '-';
            $data['agama'] = $data['agama'] ?: 'Islam';
            $data['id_provinsi'] = '33';
            $data['id_kabupaten'] = '3304';
            $data['id_kecamatan'] = $data['domisili_id_kecamatan'] ?: '';
            $data['id_desa'] = $data['domisili_id_desa'] ?: '';
            $data['alamat'] = $data['domisili_alamat'] ?: '-';
            $data['rt'] = $data['domisili_rt'] ?: '0';
            $data['rw'] = $data['domisili_rw'] ?: '0';
            $data['domisili_id_provinsi'] = '33';
            $data['domisili_id_kabupaten'] = '3304';
            $data['domisili_id_kecamatan'] = $data['domisili_id_kecamatan'] ?: '';
            $data['domisili_id_desa'] = $data['domisili_id_desa'] ?: '';
            $data['domisili_alamat'] = $data['domisili_alamat'] ?: '-';
            $data['domisili_rt'] = $data['domisili_rt'] ?: '0';
            $data['domisili_rw'] = $data['domisili_rw'] ?: '0';
            $data['no_telp'] = $data['no_telp'] ?: '-';
            $data['foto'] = $data['foto'] ?? '';
            $data['foto_ktp'] = '';
            $data['verifikasi'] = 0;
            $data['verifikasi_time'] = now();
            $data['verifikasi_user'] = '';
            $id = DB::table('juru_parkir')->insertGetId($data);
            $msg = 'Jukir baru berhasil ditambahkan';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['ok' => true, 'message' => $msg, 'id' => $id]);
        }
        return redirect()->route('mobile.survei.index')->with('message', $msg);
    }

    /**
     * Nomor urut jukir berikutnya dengan pola P0000N.
     */
    private function nextNoJukir()
    {
        $max = DB::table('juru_parkir')
            ->selectRaw("MAX(CAST(SUBSTRING(no_juru_parkir,2) AS UNSIGNED)) as m")
            ->value('m');
        return 'P' . str_pad(((int) $max) + 1, 5, '0', STR_PAD_LEFT);
    }

    // ============================================================
    //  TITIK PARKIR: tambah / edit (marking koordinat + penamaan)
    // ============================================================

    public function titik_add()
    {
        return view('mobile.survei.titik_form', [
            'mode' => 'add',
            'action' => route('mobile.survei.titik_save'),
            'titik' => null,
            'kecamatan' => $this->kecamatanList(),
            'ruas_jalan' => DB::table('ruas_jalan')->orderBy('nama_ruas')->get(),
        ]);
    }

    public function titik_edit($id)
    {
        $titik = DB::table('titik_parkir')->where('id_titik_parkir', $id)->first();
        if (!$titik) {
            return redirect()->route('mobile.survei.index')->with('message', 'Titik tidak ditemukan');
        }

        return view('mobile.survei.titik_form', [
            'mode' => 'edit',
            'action' => route('mobile.survei.titik_save'),
            'titik' => $titik,
            'kecamatan' => $this->kecamatanList(),
            'ruas_jalan' => DB::table('ruas_jalan')->orderBy('nama_ruas')->get(),
        ]);
    }

    public function titik_save(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:100',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
            'titik_lat' => 'required|numeric',
            'titik_lng' => 'required|numeric',
        ]);

        $id = $request->input('id_titik_parkir');

        // id_ruas_jalan NOT NULL di tabel: gunakan 0 bila belum dipilih
        $idRuas = $request->input('id_ruas_jalan');
        $idRuas = ($idRuas === null || $idRuas === '') ? 0 : (int) $idRuas;

        $panjang = $request->input('panjang_lokasi');
        $lebar   = $request->input('lebar_lokasi');
        $luas    = $request->input('luas_lokasi');
        if (($luas === null || $luas === '') && is_numeric($panjang) && is_numeric($lebar)) {
            $luas = round((float) $panjang * (float) $lebar, 2);
        }

        $data = [
            'jenis_fasilitas' => $request->input('jenis_fasilitas') ?: 'luar',
            'jenis_parkir_luar' => $request->input('jenis_parkir_luar') ?: 'tpk',
            'nama_lokasi' => $request->input('nama_lokasi'),
            'panjang_lokasi' => is_numeric($panjang) ? $panjang : 0,
            'lebar_lokasi' => is_numeric($lebar) ? $lebar : 0,
            'luas_lokasi' => is_numeric($luas) ? $luas : 0,
            'srp_motor' => $request->input('srp_motor') ?: null,
            'srp_mobil' => $request->input('srp_mobil') ?: null,
            'id_kecamatan' => $request->input('id_kecamatan'),
            'id_desa' => $request->input('id_desa'),
            'jenis_desa' => $request->input('jenis_desa') ?: 'Desa',
            'id_ruas_jalan' => $idRuas,
            'titik_lat' => $request->input('titik_lat'),
            'titik_lng' => $request->input('titik_lng'),
            'update_time' => now(),
            'update_user' => session('username', 'admin'),
        ];

        if ($request->hasFile('foto_lokasi')) {
            $data['foto_lokasi'] = $this->saveUpload($request->file('foto_lokasi'), 'uploads/titik_parkir');
        }

        if ($id) {
            DB::table('titik_parkir')->where('id_titik_parkir', $id)->update($data);
            $msg = 'Titik parkir berhasil diperbarui';
        } else {
            $data['data_pendukung'] = '';
            $id = DB::table('titik_parkir')->insertGetId($data);
            $msg = 'Titik parkir baru berhasil ditambahkan';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['ok' => true, 'message' => $msg, 'id' => $id]);
        }
        return redirect()->route('mobile.survei.index')->with('message', $msg);
    }

    // ============================================================
    //  Util
    // ============================================================

    public function desa_json($id_kecamatan)
    {
        $desa = DB::table('wilayah_desa')
            ->where('kecamatan_id', $id_kecamatan)
            ->orderBy('nama')
            ->get(['id', 'nama']);
        return response()->json($desa);
    }

    private function kecamatanList()
    {
        return DB::table('wilayah_kecamatan')
            ->where('kabupaten_id', '3304') // Banjarnegara
            ->orderBy('nama')
            ->get();
    }

    /**
     * Simpan file upload langsung ke public/{dir} agar tidak bergantung pada storage:link.
     */
    private function saveUpload($file, $dir)
    {
        if (!is_dir(public_path($dir))) {
            @mkdir(public_path($dir), 0755, true);
        }
        $ext = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = time() . '_' . uniqid() . '.' . $ext;
        $file->move(public_path($dir), $filename);
        return $dir . '/' . $filename;
    }
}
