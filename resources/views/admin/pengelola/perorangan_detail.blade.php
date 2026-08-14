@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header bg-blue">
                <h5 class="m-b-0">Detail Pengelola Perorangan</h5>
              </div>
            <div class="card-body">
              <style>
                .pp-hero{border-radius:16px;padding:14px 14px 12px;background:radial-gradient(900px 340px at 10% 0%,rgba(34,211,238,.35),transparent 60%),radial-gradient(800px 320px at 90% 30%,rgba(99,102,241,.30),transparent 55%),linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%);color:#fff;box-shadow:0 18px 45px rgba(0,0,0,.14);margin-bottom:16px}
                .pp-hero .pp-title{margin:0;font-weight:800;letter-spacing:.2px}
                .pp-hero .pp-sub{margin-top:6px;color:rgba(255,255,255,.75)}
                .pp-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);color:#fff;padding:7px 10px;border-radius:999px;font-size:12px;line-height:1}
                .pp-meta{margin-top:10px;display:flex;flex-wrap:wrap;gap:10px}
                .pp-grid{margin-left:-10px;margin-right:-10px}
                .pp-grid>[class*="col-"]{padding-left:10px;padding-right:10px;margin-bottom:16px}
                .pp-box{border:1px solid rgba(15,23,42,.08);border-radius:16px;background:#fff;box-shadow:0 14px 34px rgba(15,23,42,.06);padding:14px}
                .pp-box h6{margin:0 0 10px;font-weight:800;color:#0f172a}
                .pp-kv{display:flex;justify-content:space-between;gap:12px;padding:8px 0;border-bottom:1px dashed rgba(15,23,42,.10)}
                .pp-kv:last-child{border-bottom:0}
                .pp-k{color:rgba(15,23,42,.70)}
                .pp-v{font-weight:600;color:#0f172a;text-align:right}
                .pp-imgs{display:flex;gap:12px;flex-wrap:wrap}
                .pp-thumb{width:110px;height:110px;border-radius:14px;overflow:hidden;border:1px solid rgba(15,23,42,.10);box-shadow:0 10px 24px rgba(15,23,42,.08);background:#fff}
                .pp-thumb img{width:100%;height:100%;object-fit:cover;display:block}
                @media (max-width:991px){.pp-v{text-align:left}}
              </style>

              <div class="pp-hero">
                <h5 class="pp-title">Detail Pengelola Perorangan</h5>
                <div class="pp-sub">Informasi identitas, alamat, dan dokumen pendukung.</div>
                <div class="pp-meta">
                  <span class="pp-pill"><i class="fa fa-id-card"></i> NIK: {{ $row1->nik ?? '-' }}</span>
                  <span class="pp-pill"><i class="fa fa-user"></i> {{ $row1->nama ?? '-' }}</span>
                </div>
              </div>

              <div class="row pp-grid">
                <div class="col-lg-6">
                  <div class="pp-box">
                    <h6>Identitas Pribadi</h6>
                    <div class="pp-kv"><div class="pp-k">NIK</div><div class="pp-v">{{ $row1->nik ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Nama</div><div class="pp-v">{{ $row1->nama ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Tempat Lahir</div><div class="pp-v">{{ $row1->tempat_lahir ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Tanggal Lahir</div><div class="pp-v">{{ !empty($row1->tanggal_lahir) ? parse_tgl($row1->tanggal_lahir) : '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Jenis Kelamin</div><div class="pp-v">{{ ($row1->jk ?? '') === 'L' ? 'Laki-laki' : ((($row1->jk ?? '') === 'P') ? 'Perempuan' : '-') }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Agama</div><div class="pp-v">{{ $row1->agama ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Kewarganegaraan</div><div class="pp-v">{{ $row1->kewarganegaraan ?? '-' }}</div></div>
                  </div>

                  <div class="pp-box" style="margin-top:16px;">
                    <h6>Alamat KTP</h6>
                    <div class="pp-kv"><div class="pp-k">Provinsi</div><div class="pp-v">{{ $row1->prov ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Kabupaten</div><div class="pp-v">{{ $row1->kab ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Kecamatan</div><div class="pp-v">{{ $row1->kec ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Kelurahan/Desa</div><div class="pp-v">{{ $row1->desa ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Alamat</div><div class="pp-v">{{ $row1->alamat ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">RT/RW</div><div class="pp-v">{{ (($row1->rt ?? '') !== '' || ($row1->rw ?? '') !== '') ? ('RT '.($row1->rt ?? '-').' RW '.($row1->rw ?? '-')) : '-' }}</div></div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="pp-box">
                    <h6>Alamat Domisili</h6>
                    <div class="pp-kv"><div class="pp-k">Provinsi</div><div class="pp-v">{{ $row2->prov ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Kabupaten</div><div class="pp-v">{{ $row2->kab ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Kecamatan</div><div class="pp-v">{{ $row2->kec ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Kelurahan/Desa</div><div class="pp-v">{{ $row2->desa ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">Alamat</div><div class="pp-v">{{ $row2->alamat ?? '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">RT/RW</div><div class="pp-v">{{ (($row2->rt ?? '') !== '' || ($row2->rw ?? '') !== '') ? ('RT '.($row2->rt ?? '-').' RW '.($row2->rw ?? '-')) : '-' }}</div></div>
                    <div class="pp-kv"><div class="pp-k">No. Telp</div><div class="pp-v">{{ $row2->no_telp ?? '-' }}</div></div>
                  </div>

                  <div class="pp-box" style="margin-top:16px;">
                    <h6>Dokumen</h6>
                    <div class="pp-imgs">
                      <div>
                        <div class="pp-k" style="margin-bottom:8px;">Foto</div>
                        @if(!empty($row2->foto))
                          <a class="pp-thumb" href="{{ asset($row2->foto) }}" target="_blank">
                            <img src="{{ asset($row2->foto) }}" alt="Foto">
                          </a>
                        @else
                          <div class="pp-v">-</div>
                        @endif
                      </div>
                      <div>
                        <div class="pp-k" style="margin-bottom:8px;">Foto KTP</div>
                        @if(!empty($row2->foto_ktp))
                          <a class="pp-thumb" href="{{ asset($row2->foto_ktp) }}" target="_blank">
                            <img src="{{ asset($row2->foto_ktp) }}" alt="Foto KTP">
                          </a>
                        @else
                          <div class="pp-v">-</div>
                        @endif
                      </div>
                    </div>
                    <div style="margin-top:14px;">
                      <a href="{{ route('admin.pengelola.perorangan') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
