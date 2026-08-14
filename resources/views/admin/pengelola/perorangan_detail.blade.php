@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
    <!-- Header Page Actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 10px;">
      <div>
        <h4 style="font-weight: 800; margin: 0; color: #1e293b; letter-spacing: -0.5px;">Detail Pengelola Perorangan</h4>
        <p style="color: #64748b; margin: 4px 0 0 0; font-size: 13px;">Kelola informasi profil, data verifikasi, dan dokumen pendukung.</p>
      </div>
      <div>
        <a href="{{ route('admin.pengelola.perorangan') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 12px; font-weight: 600; padding: 8px 16px; border: 1px solid #cbd5e1; background: #fff; color: #475569;">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="row">
      <!-- Left Column: Profile Card & Documents -->
      <div class="col-lg-4 col-md-5 m-b-3">
        
        <!-- Profile Summary Card -->
        <div class="card border-0" style="border-radius: 20px; overflow: hidden; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; margin-bottom: 20px;">
          <!-- Top Background Header -->
          <div style="height: 90px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);"></div>
          
          <div class="text-center" style="margin-top: -50px; padding: 0 20px 24px 20px;">
            @if(!empty($row2->foto))
              <img src="{{ asset(ltrim($row2->foto, './')) }}" alt="Foto Jukir" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            @else
              <div style="width: 100px; height: 100px; border-radius: 50%; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; border: 4px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
                <i class="fa fa-user-circle-o" style="font-size: 50px; color: #94a3b8;"></i>
              </div>
            @endif

            <h5 style="font-weight: 800; margin-top: 12px; color: #0f172a; margin-bottom: 4px;">{{ $row1->nama ?? '-' }}</h5>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 12px;">NIK: {{ $row1->nik ?? '-' }}</p>

            @if(($row1->verifikasi ?? 0) == 1)
              <span class="badge" style="background: rgba(16, 185, 129, 0.12); color: #059669; font-weight: 700; font-size: 11px; padding: 6px 12px; border-radius: 999px;">
                <i class="fa fa-check-circle" style="margin-right: 4px;"></i> Terverifikasi
              </span>
            @else
              <span class="badge" style="background: rgba(239, 68, 68, 0.12); color: #dc2626; font-weight: 700; font-size: 11px; padding: 6px 12px; border-radius: 999px;">
                <i class="fa fa-exclamation-circle" style="margin-right: 4px;"></i> Belum Verifikasi
              </span>
            @endif
          </div>

          <div style="border-top: 1px solid #f1f5f9; padding: 18px 24px; background: #f8fafc;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <div style="width: 36px; height: 36px; border-radius: 10px; background: #e0f2fe; display: flex; align-items: center; justify-content: center; color: #0284c7;">
                <i class="fa fa-phone"></i>
              </div>
              <div>
                <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Nomor Telepon</div>
                <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row2->no_telp ?? '-' }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Document Preview Widget -->
        <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 20px;">
          <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px;">Dokumen Pengelola</h6>
          
          <div style="display: flex; gap: 16px; flex-direction: column;">
            
            <!-- Foto KTP -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: space-between;">
              <div style="display: flex; align-items: center; gap: 12px;">
                <div style="font-size: 20px; color: #64748b;"><i class="fa fa-file-image-o"></i></div>
                <div>
                  <div style="font-weight: 700; font-size: 13px; color: #334155;">Foto KTP</div>
                  <div style="font-size: 11px; color: #64748b;">E-KTP Resmi</div>
                </div>
              </div>
              <div>
                @if(!empty($row2->foto_ktp))
                  <a href="{{ asset(ltrim($row2->foto_ktp, './')) }}" target="_blank" class="btn btn-light btn-sm" style="border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; font-size: 11px; background: #fff;">Lihat</a>
                @else
                  <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">Kosong</span>
                @endif
              </div>
            </div>

            <!-- Pas Foto -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: space-between;">
              <div style="display: flex; align-items: center; gap: 12px;">
                <div style="font-size: 20px; color: #64748b;"><i class="fa fa-user-circle"></i></div>
                <div>
                  <div style="font-weight: 700; font-size: 13px; color: #334155;">Pas Foto</div>
                  <div style="font-size: 11px; color: #64748b;">Foto Diri Resmi</div>
                </div>
              </div>
              <div>
                @if(!empty($row2->foto))
                  <a href="{{ asset(ltrim($row2->foto, './')) }}" target="_blank" class="btn btn-light btn-sm" style="border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; font-size: 11px; background: #fff;">Lihat</a>
                @else
                  <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">Kosong</span>
                @endif
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Right Column: Identitas & Alamat Details -->
      <div class="col-lg-8 col-md-7">
        
        <!-- Identitas Pribadi Card -->
        <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 24px; margin-bottom: 20px;">
          <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fa fa-id-card-o text-primary"></i> Identitas Pribadi
          </h6>
          
          <div class="row">
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Nama Lengkap</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row1->nama ?? '-' }}</div>
            </div>
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Nomor Induk Kependudukan (NIK)</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row1->nik ?? '-' }}</div>
            </div>
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Tempat &amp; Tanggal Lahir</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row1->tempat_lahir ?? '-' }}, {{ !empty($row1->tanggal_lahir) ? parse_tgl($row1->tanggal_lahir) : '-' }}</div>
            </div>
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Jenis Kelamin</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ ($row1->jk ?? '') === 'L' ? 'Laki-laki' : ((($row1->jk ?? '') === 'P') ? 'Perempuan' : '-') }}</div>
            </div>
            <div class="col-md-6" style="margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Agama</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row1->agama ?? '-' }}</div>
            </div>
            <div class="col-md-6" style="margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Kewarganegaraan</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row1->kewarganegaraan ?? '-' }}</div>
            </div>
          </div>
        </div>

        <!-- Penempatan / Tugas SK Card -->
        <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 24px; margin-bottom: 20px;">
          <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fa fa-map text-primary"></i> Penempatan / Tugas SK Saat Ini
          </h6>
          
          @if($sk->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 16px;">
              @foreach($sk as $item)
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 16px;">
                  <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 10px; margin-bottom: 12px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                    <div>
                      <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">No. SK / Perjanjian</span>
                      <div style="font-size: 14px; font-weight: 800; color: #0f172a;">{{ $item->no_sk }}</div>
                    </div>
                    <div style="text-align: right;">
                      <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 11px; padding: 4px 10px; border-radius: 6px;">
                        Tahun: {{ $item->tahun_pengelolaan }}
                      </span>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6" style="margin-bottom: 10px;">
                      <div style="font-size: 11px; color: #64748b; font-weight: 600;">Lokasi Penempatan</div>
                      <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $item->nama_lokasi }} ({{ $item->jenis_lokasi }})</div>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                      <div style="font-size: 11px; color: #64748b; font-weight: 600;">Zona Wilayah</div>
                      <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $item->zona }}</div>
                    </div>
                    <div class="col-md-6">
                      <div style="font-size: 11px; color: #64748b; font-weight: 600;">Retribusi Per Bulan</div>
                      <div style="font-size: 13px; font-weight: 700; color: #0284c7;">Rp. {{ number_format($item->retribusi_perbulan, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-md-6">
                      <div style="font-size: 11px; color: #64748b; font-weight: 600;">Retribusi Per Tahun</div>
                      <div style="font-size: 13px; font-weight: 700; color: #0284c7;">Rp. {{ number_format($item->retribusi_pertahun, 0, ',', '.') }}</div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 14px; padding: 24px; text-align: center; color: #64748b; font-size: 13px;">
              <i class="fa fa-info-circle" style="font-size: 20px; margin-bottom: 6px; display: block; color: #94a3b8;"></i>
              Belum ada SK penugasan / penempatan aktif untuk pengelola ini.
            </div>
          @endif
        </div>

        <!-- Alamat KTP & Domisili Grid -->
        <div class="row">
          
          <!-- Alamat KTP Card -->
          <div class="col-md-6 m-b-3">
            <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 20px; height: 100%;">
              <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <i class="fa fa-home text-info"></i> Alamat KTP
              </h6>
              
              <div style="display: flex; flex-direction: column; gap: 12px;">
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Provinsi</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row1->prov ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Kabupaten</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row1->kab ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Kecamatan</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row1->kec ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Kelurahan / Desa</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row1->desa ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Alamat Lengkap</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155; line-height: 1.4;">{{ $row1->alamat ?? '-' }} (RT {{ $row1->rt ?? '-' }} / RW {{ $row1->rw ?? '-' }})</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Alamat Domisili Card -->
          <div class="col-md-6 m-b-3">
            <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 20px; height: 100%;">
              <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <i class="fa fa-map-marker text-success"></i> Alamat Domisili
              </h6>
              
              <div style="display: flex; flex-direction: column; gap: 12px;">
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Provinsi</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row2->prov ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Kabupaten</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row2->kab ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Kecamatan</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row2->kec ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Kelurahan / Desa</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row2->desa ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase;">Alamat Lengkap</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155; line-height: 1.4;">{{ $row2->alamat ?? '-' }} (RT {{ $row2->rt ?? '-' }} / RW {{ $row2->rw ?? '-' }})</div>
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
