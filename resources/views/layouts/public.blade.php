<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SIAP Dinhub Banjarnegara</title>
    <meta content="Sistem Informasi Aplikasi Parkir" name="description">
    <meta content="siap, parkir, dinas perhubungan, dinhub, banjarnegara" name="keywords">
    <meta content="exadata, fariezjm" name="authors">

    <!-- Favicons -->
    <link href="{{ asset('images/favicon.png') }}" rel="icon">
    <link href="{{ asset('images/favicon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS v5.3 (Modern) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS (UI UX Promax) -->
    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --secondary: #0f172a;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-500: #64748b;
            --slate-700: #334155;
            --font-heading: 'Plus Jakarta Sans', sans-serif;
            --font-body: 'Inter', sans-serif;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(15, 23, 42, 0.08);
        }

        body {
            font-family: var(--font-body);
            color: var(--secondary);
            background-color: #fafafa;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
        }

        /* Header Navbar Glassmorphism */
        .header {
            background: var(--glass-bg);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .brand-logo {
            height: 40px;
            width: auto;
        }
        
        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }
        
        .brand-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: 0.5px;
        }
        
        .brand-sub {
            font-size: 11px;
            color: var(--slate-500);
            font-weight: 500;
        }

        .nav-link {
            font-weight: 500;
            color: var(--slate-700);
            padding: 8px 16px !important;
            border-radius: 99px;
            transition: all 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background: var(--primary-light);
        }

        .btn-getstarted {
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 99px;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25);
        }

        .btn-getstarted:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.35);
        }

        /* Footer */
        .footer {
            background: var(--secondary);
            color: var(--slate-300);
            padding: 60px 0 30px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .footer-brand {
            color: #fff;
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .footer-links a {
            color: var(--slate-300);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-bottom {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
            font-size: 14px;
        }

        /* Floating Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary);
            color: #fff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(2, 132, 199, 0.3);
            text-decoration: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Header / Navbar -->
    <header class="header fixed-top py-2">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ route('public.home') }}" class="navbar-brand">
                <img src="{{ asset('assets/pub/img/logo.png') }}" alt="Logo" class="brand-logo" style="height: 48px; width: auto;">
            </a>

            <nav class="navbar navbar-expand-lg d-none d-lg-block">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('public.home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Biaya Parkir</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Pengelola</a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4 mt-2">
                            <li><a class="dropdown-item py-2" href="{{ route('admin.login') }}">Login Admin & Pengelola</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="d-flex align-items-center gap-3">
                <a href="#contact" class="btn-getstarted">Lapor Pengaduan</a>
                <button class="navbar-toggler d-lg-none border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                    <i class="bi bi-list fs-1 text-dark"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Offcanvas Mobile Menu -->
    <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">SIAP Banjarnegara</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav gap-3">
                <li class="nav-item"><a class="nav-link active" href="{{ route('public.home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#pricing">Biaya Parkir</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Login Pengelola</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content Yield -->
    <main style="margin-top: 80px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="footer-brand">SIAP Dinhub Bna</div>
                    <p class="text-slate-400" style="max-width: 440px;">
                        Sistem Informasi Aplikasi Parkir Banjarnegara. Memberikan kemudahan transparansi, pengelolaan, dan pengaduan layanan parkir demi kenyamanan publik.
                    </p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="footer-links d-flex gap-4 justify-content-lg-end mb-4">
                        <a href="{{ route('public.home') }}">Beranda</a>
                        <a href="#about">Tentang</a>
                        <a href="#">Aturan Penggunaan</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div>
                    &copy; {{ date('Y') }} Copyright <strong>SIAP Dinhub Banjarnegara</strong>. All Rights Reserved
                </div>
                <div>
                    Developed by <a href="https://clasnet.co.id/" target="_blank" class="fw-semibold text-white text-decoration-none">Clasnet</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop"><i class="bi bi-arrow-up-short fs-4"></i></a>

    <!-- Bootstrap Bundle JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- UI/UX Scroll Interaction -->
    <script>
        const backToTop = document.getElementById('backToTop');
        const header = document.querySelector('.header');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                backToTop.classList.add('active');
                header.classList.add('shadow-sm');
            } else {
                backToTop.classList.remove('active');
                header.classList.remove('shadow-sm');
            }
        });
    </script>
</body>
</html>
