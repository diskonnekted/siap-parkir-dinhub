@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
    <!-- Header Page Actions -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 10px;">
      <div>
        <h4 style="font-weight: 800; margin: 0; color: #1e293b; letter-spacing: -0.5px;">Detail Pengelola Badan</h4>
        <p style="color: #64748b; margin: 4px 0 0 0; font-size: 13px;">Kelola profil badan usaha, data legalitas akta, kepengurusan, dan dokumen perizinan.</p>
      </div>
      <div>
        <a href="{{ route('admin.pengelola.badan') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 12px; font-weight: 600; padding: 8px 16px; border: 1px solid #cbd5e1; background: #fff; color: #475569;">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="row">
      <!-- Left Column: Company Card & Legal Documents -->
      <div class="col-lg-4 col-md-5 m-b-3">
        
        <!-- Company Profile Summary Card -->
        <div class="card border-0" style="border-radius: 20px; overflow: hidden; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; margin-bottom: 20px;">
          <!-- Top Background Header -->
          <div style="height: 90px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);"></div>
          
          <div class="text-center" style="margin-top: -45px; padding: 0 20px 24px 20px;">
            <div style="width: 90px; height: 90px; border-radius: 24px; background: #fff; display: inline-flex; align-items: center; justify-content: center; border: 4px solid #fff; box-shadow: 0 10px 20px rgba(99,102,241,0.15);">
              <i class="fa fa-building text-primary" style="font-size: 40px; color: #4f46e5 !important;"></i>
            </div>

            <h5 style="font-weight: 800; margin-top: 15px; color: #0f172a; margin-bottom: 6px; font-size: 16px;">{{ $row->nama_badan }}</h5>
            <p style="color: #64748b; font-size: 13px; margin-bottom: 12px;">NIB: {{ $row->nib ?? '-' }}</p>

            @if(($row->verifikasi ?? 0) == 1)
              <span class="badge" style="background: rgba(16, 185, 129, 0.12); color: #059669; font-weight: 700; font-size: 11px; padding: 6px 12px; border-radius: 999px;">
                <i class="fa fa-check-circle" style="margin-right: 4px;"></i> Terverifikasi
              </span>
            @else
              <span class="badge" style="background: rgba(239, 68, 68, 0.12); color: #dc2626; font-weight: 700; font-size: 11px; padding: 6px 12px; border-radius: 999px;">
                <i class="fa fa-exclamation-circle" style="margin-right: 4px;"></i> Belum Verifikasi
              </span>
            @endif
          </div>

          <div style="border-top: 1px solid #f1f5f9; padding: 18px 24px; background: #f8fafc; display: flex; flex-direction: column; gap: 12px;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <div style="width: 32px; height: 32px; border-radius: 8px; background: #e0f2fe; display: flex; align-items: center; justify-content: center; color: #0284c7;"><i class="fa fa-phone"></i></div>
              <div>
                <div style="font-size: 10px; color: #64748b; font-weight: 600; text-transform: uppercase;">Telepon</div>
                <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->no_telp ?? '-' }}</div>
              </div>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
              <div style="width: 32px; height: 32px; border-radius: 8px; background: #f0fdf4; display: flex; align-items: center; justify-content: center; color: #16a34a;"><i class="fa fa-envelope-o"></i></div>
              <div>
                <div style="font-size: 10px; color: #64748b; font-weight: 600; text-transform: uppercase;">Email</div>
                <div style="font-size: 13px; font-weight: 700; color: #334155; word-break: break-all;">{{ $row->email ?? '-' }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Document Preview Widget -->
        <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 20px;">
          <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px;">Dokumen Perizinan &amp; Legalitas</h6>
          
          <div style="display: flex; gap: 12px; flex-direction: column;">
            <!-- NIB -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: space-between;">
              <div style="display: flex; align-items: center; gap: 12px;">
                <div style="font-size: 20px; color: #64748b;"><i class="fa fa-file-pdf-o text-danger"></i></div>
                <div>
                  <div style="font-weight: 700; font-size: 13px; color: #334155;">Dokumen NIB</div>
                  <div style="font-size: 11px; color: #64748b;">Nomor Induk Berusaha</div>
                </div>
              </div>
              <div>
                @if(!empty($row->foto_nib))
                  <a href="{{ asset(ltrim($row->foto_nib, './')) }}" target="_blank" class="btn btn-light btn-sm" style="border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; font-size: 11px; background: #fff;">Lihat</a>
                @else
                  <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">Kosong</span>
                @endif
              </div>
            </div>

            <!-- Surat Keterangan Kemenkumham -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: space-between;">
              <div style="display: flex; align-items: center; gap: 12px;">
                <div style="font-size: 20px; color: #64748b;"><i class="fa fa-certificate text-warning"></i></div>
                <div>
                  <div style="font-weight: 700; font-size: 13px; color: #334155;">Suket Kemenkumham</div>
                  <div style="font-size: 11px; color: #64748b;">Legalitas Kemenkumham</div>
                </div>
              </div>
              <div>
                @if(!empty($row->foto_suket))
                  <a href="{{ asset(ltrim($row->foto_suket, './')) }}" target="_blank" class="btn btn-light btn-sm" style="border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; font-size: 11px; background: #fff;">Lihat</a>
                @else
                  <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">Kosong</span>
                @endif
              </div>
            </div>

            <!-- Foto Kantor -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: space-between;">
              <div style="display: flex; align-items: center; gap: 12px;">
                <div style="font-size: 20px; color: #64748b;"><i class="fa fa-image text-info"></i></div>
                <div>
                  <div style="font-weight: 700; font-size: 13px; color: #334155;">Foto Kantor</div>
                  <div style="font-size: 11px; color: #64748b;">Tampak Depan Kantor</div>
                </div>
              </div>
              <div>
                @if(!empty($row->foto_kantor))
                  <a href="{{ asset(ltrim($row->foto_kantor, './')) }}" target="_blank" class="btn btn-light btn-sm" style="border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; font-size: 11px; background: #fff;">Lihat</a>
                @else
                  <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">Kosong</span>
                @endif
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Right Column: Corporate, Akta, & Pengurus Details -->
      <div class="col-lg-8 col-md-7">
        
        <!-- Identitas Badan Pengelola Card -->
        <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 24px; margin-bottom: 20px;">
          <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fa fa-briefcase text-primary"></i> Profil Badan Pengelola
          </h6>
          
          <div class="row">
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Nama Badan Usaha</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row->nama_badan }}</div>
            </div>
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Nomor Induk Berusaha (NIB)</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row->nib ?? '-' }}</div>
            </div>
            <div class="col-md-12" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Alamat Kantor Sesuai Perizinan</div>
              <div style="font-size: 13px; font-weight: 700; color: #1e293b; line-height: 1.4;">
                {{ $row->alamat }} (RT {{ $row->rt }} / RW {{ $row->rw }}), {{ $row->desa }}, Kec. {{ $row->kec }}, {{ $row->kab }}, {{ $row->prov }}
              </div>
            </div>
          </div>
        </div>

        <!-- Akta Pendirian & Perubahan Card -->
        <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 24px; margin-bottom: 20px;">
          <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fa fa-file-text-o text-info"></i> Data Akta Perusahaan
          </h6>
          
          <div class="row">
            <!-- Akta Pendirian -->
            <div class="col-md-6" style="border-right: 1px solid #f1f5f9; padding-right: 20px;">
              <div style="font-size: 12px; font-weight: 800; color: #3b82f6; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">Akta Pendirian</div>
              
              <div style="display: flex; flex-direction: column; gap: 12px;">
                <div>
                  <div style="font-size: 10px; color: #64748b; font-weight: 600;">Nomor Akta</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->no_akta ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 10px; color: #64748b; font-weight: 600;">Tanggal Akta</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ !empty($row->tgl_akta) ? parse_tgl($row->tgl_akta) : '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 10px; color: #64748b; font-weight: 600;">Nama Notaris</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->nama_notaris ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 10px; color: #64748b; font-weight: 600;">SK Kemenkumham</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155; word-break: break-all;">{{ $row->no_suket_kemenkumham ?? '-' }}</div>
                </div>
              </div>
            </div>

            <!-- Akta Perubahan -->
            <div class="col-md-6" style="padding-left: 20px;">
              <div style="font-size: 12px; font-weight: 800; color: #10b981; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">Akta Perubahan Terbaru</div>
              
              <div style="display: flex; flex-direction: column; gap: 12px;">
                <div>
                  <div style="font-size: 10px; color: #64748b; font-weight: 600;">Nomor Akta Perubahan</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->perubahan_no_akta ?? '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 10px; color: #64748b; font-weight: 600;">Tanggal Akta Perubahan</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ !empty($row->perubahan_tgl_akta) ? parse_tgl($row->perubahan_tgl_akta) : '-' }}</div>
                </div>
                <div>
                  <div style="font-size: 10px; color: #64748b; font-weight: 600;">Nama Notaris Perubahan</div>
                  <div style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->perubahan_nama_notaris ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Pengurus Card -->
        <div class="card border-0" style="border-radius: 20px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid rgba(226,232,240,0.8) !important; padding: 24px;">
          <h6 style="font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fa fa-users text-success"></i> Data Kepengurusan (Penanggung Jawab)
          </h6>
          
          <div class="row">
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Nama Pengurus</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row->pengurus_nama ?? '-' }}</div>
            </div>
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Jabatan</div>
              <div style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $row->pengurus_jabatan ?? '-' }}</div>
            </div>
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">NIK Pengurus</div>
              <div style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ $row->pengurus_nik ?? '-' }}</div>
            </div>
            <div class="col-md-6" style="padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 12px;">
              <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">NPWP Badan</div>
              <div style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ $row->npwp ?? '-' }}</div>
            </div>

            <!-- Previews Pengurus -->
            <div class="col-12 mt-2">
              <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <!-- Pas Foto Pengurus -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px; display: flex; align-items: center; gap: 10px;">
                  @if(!empty($row->pengurus_foto))
                    <img src="{{ asset(ltrim($row->pengurus_foto, './')) }}" style="width: 48px; height: 48px; border-radius: 8px; object-fit: cover;">
                    <div>
                      <div style="font-size: 12px; font-weight: 700; color: #334155;">Pas Foto Pengurus</div>
                      <a href="{{ asset(ltrim($row->pengurus_foto, './')) }}" target="_blank" style="font-size: 11px; font-weight: 600; color: #3b82f6;">Lihat</a>
                    </div>
                  @else
                    <div style="width: 48px; height: 48px; border-radius: 8px; background: #e2e8f0; display: flex; align-items: center; justify-content: center;"><i class="fa fa-user-circle-o text-muted"></i></div>
                    <div>
                      <div style="font-size: 12px; font-weight: 700; color: #94a3b8;">Foto Pengurus</div>
                      <span style="font-size: 11px; color: #94a3b8;">Kosong</span>
                    </div>
                  @endif
                </div>

                <!-- Foto KTP Pengurus -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px; display: flex; align-items: center; gap: 10px;">
                  @if(!empty($row->pengurus_ktp))
                    <img src="{{ asset(ltrim($row->pengurus_ktp, './')) }}" style="width: 48px; height: 48px; border-radius: 8px; object-fit: cover;">
                    <div>
                      <div style="font-size: 12px; font-weight: 700; color: #334155;">Foto KTP Pengurus</div>
                      <a href="{{ asset(ltrim($row->pengurus_ktp, './')) }}" target="_blank" style="font-size: 11px; font-weight: 600; color: #3b82f6;">Lihat</a>
                    </div>
                  @else
                    <div style="width: 48px; height: 48px; border-radius: 8px; background: #e2e8f0; display: flex; align-items: center; justify-content: center;"><i class="fa fa-id-card-o text-muted"></i></div>
                    <div>
                      <div style="font-size: 12px; font-weight: 700; color: #94a3b8;">KTP Pengurus</div>
                      <span style="font-size: 11px; color: #94a3b8;">Kosong</span>
                    </div>
                  @endif
                </div>

                <!-- Foto NPWP -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px; display: flex; align-items: center; gap: 10px;">
                  @if(!empty($row->foto_npwp))
                    <img src="{{ asset(ltrim($row->foto_npwp, './')) }}" style="width: 48px; height: 48px; border-radius: 8px; object-fit: cover;">
                    <div>
                      <div style="font-size: 12px; font-weight: 700; color: #334155;">Foto NPWP</div>
                      <a href="{{ asset(ltrim($row->foto_npwp, './')) }}" target="_blank" style="font-size: 11px; font-weight: 600; color: #3b82f6;">Lihat</a>
                    </div>
                  @else
                    <div style="width: 48px; height: 48px; border-radius: 8px; background: #e2e8f0; display: flex; align-items: center; justify-content: center;"><i class="fa fa-credit-card text-muted"></i></div>
                    <div>
                      <div style="font-size: 12px; font-weight: 700; color: #94a3b8;">NPWP</div>
                      <span style="font-size: 11px; color: #94a3b8;">Kosong</span>
                    </div>
                  @endif
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
