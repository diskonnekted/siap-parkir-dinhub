@extends('layouts.public')

@section('content')
<!-- Hero Section (UIUX Promax) -->
<section id="hero" class="position-relative overflow-hidden py-5 d-flex align-items-center" style="min-height: 85vh; background: radial-gradient(1100px 480px at 15% 10%, rgba(2, 132, 199, 0.15), transparent 60%), radial-gradient(900px 420px at 90% 30%, rgba(99, 102, 241, 0.10), transparent 55%), #ffffff;">
  <div class="container my-auto">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-5 mb-3" style="background: var(--primary-light); color: var(--primary); font-size: 13px; font-weight: 600;">
          <i class="bi bi-shield-check"></i>
          SIAP &bull; Dinas Perhubungan Banjarnegara
        </div>
        <h1 class="display-4 fw-extrabold text-slate-900 tracking-tight lh-sm mb-3" style="font-family: var(--font-heading);">
          Informasi Parkir Lebih <span class="text-primary">Transparan</span> &amp; Terkelola.
        </h1>
        <p class="fs-5 text-slate-600 mb-4" style="max-width: 540px; font-weight: 400; line-height: 1.6;">
          SIAP mempermudah masyarakat memverifikasi juru parkir resmi, mencari lokasi parkir legal, serta menyampaikan pengaduan perparkiran langsung ke Dinas Perhubungan.
        </p>

        <div class="d-flex flex-wrap gap-3 mb-4">
          <a href="#services" class="btn btn-primary px-4 py-3 rounded-pill fw-semibold shadow-sm"><i class="bi bi-compass me-2"></i> Jelajahi Layanan</a>
          <a href="#contact" class="btn btn-outline-dark px-4 py-3 rounded-pill fw-semibold"><i class="bi bi-chat-dots me-2"></i> Lapor Pengaduan</a>
        </div>

        <div class="d-flex flex-wrap gap-3">
          <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-xs"><i class="bi bi-geo-alt text-primary me-2"></i> {{ $stats['titik'] }} Titik Parkir</span>
          <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-xs"><i class="bi bi-person-badge text-success me-2"></i> {{ $stats['jukir'] }} Jukir Resmi</span>
          <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-xs"><i class="bi bi-megaphone text-warning me-2"></i> {{ $pengaduan->count() }} Pengaduan Dipublikasi</span>
        </div>
      </div>

      <div class="col-lg-6 order-1 order-lg-2">
        <div class="position-relative p-4 rounded-5" style="background: rgba(15,23,42,0.03); border: 1px dashed rgba(15,23,42,0.1);">
          <img src="{{ asset('assets/pub/img/hero-img1.png') }}" class="img-fluid rounded-4 shadow-lg w-100" alt="SIAP Hero Image" style="object-fit: cover; max-height: 380px;">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-light border-top border-bottom">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="p-2 border rounded-5 bg-white shadow-sm">
          <img src="{{ asset('assets/pub/img/counts-img.png') }}" alt="About SIAP" class="img-fluid rounded-4 w-100">
        </div>
      </div>
      <div class="col-lg-6">
        <h2 class="h1 mb-4">Tentang Aplikasi SIAP</h2>
        <p class="text-slate-600 mb-4" style="line-height: 1.7;">
          Aplikasi **SIAP** (Sistem Informasi Aplikasi Parkir) didevelop oleh **Dinas Perhubungan Kabupaten Banjarnegara** sebagai wujud transformasi digital di sektor pelayanan publik, khususnya perparkiran.
        </p>
        <div class="d-flex flex-column gap-3">
          <div class="d-flex gap-3">
            <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
              <i class="bi bi-check-lg fs-5"></i>
            </div>
            <div>
              <h5 class="mb-1">Database Parkir Digital</h5>
              <p class="text-slate-600 mb-0">Memetakan secara akurat seluruh ruas jalan dan titik parkir legal di Banjarnegara.</p>
            </div>
          </div>
          <div class="d-flex gap-3">
            <div class="flex-shrink-0 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
              <i class="bi bi-check-lg fs-5"></i>
            </div>
            <div>
              <h5 class="mb-1">Manajemen Jukir Profesional</h5>
              <p class="text-slate-600 mb-0">Mencegah aksi parkir liar dengan mendata identitas lengkap juru parkir resmi.</p>
            </div>
          </div>
          <div class="d-flex gap-3">
            <div class="flex-shrink-0 bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
              <i class="bi bi-check-lg fs-5"></i>
            </div>
            <div>
              <h5 class="mb-1">Portal Pengaduan Publik</h5>
              <p class="text-slate-600 mb-0">Memfasilitasi pelaporan pelanggaran tarif atau pelayanan secara instan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5">
  <div class="container py-4">
    <div class="text-center mb-5">
      <h2 class="h1">Layanan Utama</h2>
      <p class="text-slate-600">Akses fitur pelayanan perparkiran publik dengan mudah</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-4 text-center hover-up transition">
          <div class="bg-primary-light text-primary rounded-4 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
            <i class="bi bi-qr-code-scan fs-3"></i>
          </div>
          <h4 class="h5 mb-2">Verifikasi Jukir</h4>
          <p class="text-slate-600 mb-0 small">Scan barcode KTA Juru Parkir untuk memverifikasi keaslian dan legalitas tugasnya.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-4 text-center hover-up transition">
          <div class="bg-success-light text-success rounded-4 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
            <i class="bi bi-map fs-3"></i>
          </div>
          <h4 class="h5 mb-2">Peta Parkir Resmi</h4>
          <p class="text-slate-600 mb-0 small">Temukan lokasi kantong parkir berizin terdekat lengkap dengan detail tarifnya.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-4 text-center hover-up transition">
          <div class="bg-warning-light text-warning rounded-4 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
            <i class="bi bi-chat-left-dots fs-3"></i>
          </div>
          <h4 class="h5 mb-2">Pengaduan Online</h4>
          <p class="text-slate-600 mb-0 small">Laporkan langsung juru parkir liar, jukir tanpa karcis, atau pungutan tarif tidak resmi.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-4 text-center hover-up transition">
          <div class="bg-danger-light text-danger rounded-4 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
            <i class="bi bi-person-check fs-3"></i>
          </div>
          <h4 class="h5 mb-2">Portal Registrasi</h4>
          <p class="text-slate-600 mb-0 small">Pendaftaran terpadu bagi pemohon izin kelola parkir perorangan dan badan usaha.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-5 bg-light border-top border-bottom">
  <div class="container py-4">
    <div class="text-center mb-5">
      <h2 class="h1">Tarif Resmi Retribusi Parkir</h2>
      <p class="text-slate-600">Sesuai Peraturan Daerah Kabupaten Banjarnegara</p>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm p-4 rounded-4 text-center h-100">
          <h4 class="text-slate-500 mb-2">Sepeda Motor</h4>
          <div class="display-6 fw-bold mb-3 text-primary">Rp 2.000</div>
          <ul class="list-unstyled text-start mb-4 border-top pt-3">
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Motor Bebek &amp; Matic</li>
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Motor Sport</li>
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Sepeda Listrik</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm p-4 rounded-4 text-center h-100" style="border: 2px solid var(--primary) !important;">
          <span class="badge bg-primary text-white mx-auto px-3 py-2 rounded-pill mb-3" style="width: fit-content;">Paling Umum</span>
          <h4 class="text-slate-500 mb-2">Mobil / Minibus</h4>
          <div class="display-6 fw-bold mb-3 text-primary">Rp 4.000</div>
          <ul class="list-unstyled text-start mb-4 border-top pt-3">
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Mobil Sedan &amp; Hatchback</li>
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> SUV &amp; MPV (Keluarga)</li>
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Pick Up / Box Kecil</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm p-4 rounded-4 text-center h-100">
          <h4 class="text-slate-500 mb-2">Bus &amp; Truk Berat</h4>
          <div class="display-6 fw-bold mb-3 text-primary">Rp 6.000</div>
          <ul class="list-unstyled text-start mb-4 border-top pt-3">
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Bus Pariwisata / Angkutan</li>
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Truk Muatan (Double)</li>
            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Trailer &amp; Kontainer</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials / Feedbacks Section -->
<section id="feedbacks" class="py-5">
  <div class="container py-4">
    <div class="text-center mb-5">
      <h2 class="h1">Pengaduan &amp; Respon Terbaru</h2>
      <p class="text-slate-600">Transparansi tindak lanjut laporan pengaduan masyarakat oleh Dinhub</p>
    </div>
    <div class="row g-4">
      @forelse($pengaduan as $row)
        <div class="col-lg-6">
          <div class="card border-0 shadow-sm p-4 rounded-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-0">{{ $row->nama }}</h5>
                <span class="text-slate-500 small"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $row->lokasi }}</span>
              </div>
              <span class="badge rounded-pill px-3 py-2 
                @if($row->respon == 'belum') bg-secondary-subtle text-secondary
                @elseif($row->respon == 'sedang') bg-warning-subtle text-warning-emphasis
                @else bg-success-subtle text-success-emphasis
                @endif">
                @if($row->respon == 'belum') Belum Ditangani
                @elseif($row->respon == 'sedang') Sedang Ditangani
                @else Sudah Ditangani
                @endif
              </span>
            </div>
            <p class="text-slate-700 italic mb-4" style="font-style: italic;">
              &ldquo;{{ $row->keterangan }}&rdquo;
            </p>
            @if($row->respon_keterangan)
              <div class="p-3 bg-light rounded-3 border-start border-primary border-3">
                <strong class="d-block mb-1 text-slate-800 small"><i class="bi bi-reply-fill text-primary"></i> Respon Dinas Perhubungan:</strong>
                <p class="mb-0 text-slate-600 small">{{ $row->respon_keterangan }}</p>
              </div>
            @endif
          </div>
        </div>
      @empty
        <div class="col-12 text-center text-slate-500 py-4">
          Belum ada laporan pengaduan yang dipublikasi.
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Contact & Complaint Form Section -->
<section id="contact" class="py-5 bg-light border-top">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-5">
        <h2 class="h1 mb-3">Hubungi Kami</h2>
        <p class="text-slate-600 mb-4">
          Jika Anda memiliki pertanyaan umum atau ingin berkoordinasi secara langsung dengan Kantor Dinas Perhubungan Kabupaten Banjarnegara.
        </p>
        <div class="d-flex flex-column gap-3 mb-4">
          <div class="d-flex gap-3 align-items-center">
            <div class="bg-white border rounded-3 d-flex align-items-center justify-content-center shadow-xs" style="width: 48px; height: 48px; flex-shrink: 0;">
              <i class="bi bi-geo-alt text-primary fs-5"></i>
            </div>
            <div>
              <h6 class="mb-0">Alamat Kantor</h6>
              <span class="text-slate-600 small">Jl. Serulingmas No.1, Semampir, Banjarnegara 53418</span>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-center">
            <div class="bg-white border rounded-3 d-flex align-items-center justify-content-center shadow-xs" style="width: 48px; height: 48px; flex-shrink: 0;">
              <i class="bi bi-envelope text-primary fs-5"></i>
            </div>
            <div>
              <h6 class="mb-0">Surel Resmi</h6>
              <span class="text-slate-600 small">admin@dinhub-bna.go.id</span>
            </div>
          </div>
          <div class="d-flex gap-3 align-items-center">
            <div class="bg-white border rounded-3 d-flex align-items-center justify-content-center shadow-xs" style="width: 48px; height: 48px; flex-shrink: 0;">
              <i class="bi bi-telephone text-primary fs-5"></i>
            </div>
            <div>
              <h6 class="mb-0">Telepon Kantor</h6>
              <span class="text-slate-600 small">(0286) 591 331</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white">
          <h3 class="h2 mb-2">Formulir Pengaduan</h3>
          <p class="text-slate-500 mb-4">Lengkapi formulir di bawah ini dengan menyertakan detail laporan secara akurat.</p>

          @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
              {{ session('message') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form action="{{ route('public.pengaduan_action') }}" method="post">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control rounded-3" placeholder="Nama lengkap Anda" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">NIK (Sesuai KTP)</label>
                <input type="text" name="nik" class="form-control rounded-3" placeholder="16 digit NIK" minlength="16" maxlength="16" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Nomor WhatsApp/HP</label>
                <input type="tel" name="nohp" class="form-control rounded-3" placeholder="Contoh: 081234567xxx" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Plat Nomor Kendaraan</label>
                <input type="text" name="plat_nomor" class="form-control rounded-3" placeholder="Contoh: R 1234 DA" required>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Alamat Anda</label>
                <input type="text" name="alamat" class="form-control rounded-3" placeholder="Alamat lengkap tempat tinggal" required>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Lokasi Kejadian / Parkir</label>
                <input type="text" name="lokasi" class="form-control rounded-3" placeholder="Contoh: Depan Toko A, Jl. Pemuda" required>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Keterangan Laporan</label>
                <textarea name="keterangan" rows="4" class="form-control rounded-3" placeholder="Jelaskan secara rinci kronologi kejadian atau keluhan Anda..." required></textarea>
              </div>
              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-semibold shadow-xs">Kirim Laporan Pengaduan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CSS Micro-animations & custom classes -->
<style>
  .hover-up {
      transition: all 0.3s ease;
  }
  .hover-up:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08) !important;
  }
  .bg-primary-light { background: #e0f2fe; }
  .bg-success-light { background: #dcfce7; }
  .bg-warning-light { background: #fef9c3; }
  .bg-danger-light { background: #fee2e2; }
  
  .fw-extrabold { font-weight: 800; }
  .tracking-tight { letter-spacing: -0.5px; }
  .lh-sm { line-height: 1.25; }
  
  .text-slate-600 { color: #475569; }
  .text-slate-500 { color: #64748b; }
  .text-slate-700 { color: #334155; }
  
  .shadow-xs { box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
</style>
@endsection
