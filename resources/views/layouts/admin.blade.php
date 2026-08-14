<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SIAP Dinhub Banjarnegara | Administrator</title>
<style>
  html, body {
      background-color: #eef5f9 !important;
  }
</style>
<meta content="Sistem Informasi Aplikasi Parkir" name="description">
<meta content="siap, parkir, dinas perhubungan, dinhub, banjarnegara" name="keywords">
<meta content="exadata, fariezjm" name="authors">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ asset('images/favicon.png') }}" rel="icon">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/plugins/datatables/css/dataTables.bootstrap.min.css') }}">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('template/css/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/css/et-line-font/et-line-font.css') }}">
<link rel="stylesheet" href="{{ asset('template/css/themify-icons/themify-icons.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('template/css/simple-lineicon/simple-line-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/pengelola/plugins/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/pengelola/plugins/jquery-ui/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

  <script src="{{ asset('template/js/jquery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- Leaflet Map Assets -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
  <header class="main-header"> 
    <!-- Logo --> 
    <a href="{{ route('admin.home') }}" class="logo blue-bg"> 
    <!-- mini logo for sidebar mini 50x50 pixels --> 
    <span class="logo-mini"><img src="{{ asset('assets/pub/img/logo.png') }}" width="20px" height="20px" alt=""></span> 
    <!-- logo for regular state and mobile devices --> 
    <span class="logo-lg"><img src="{{ asset('assets/pub/img/logo.png') }}" width="200px" alt=""></span> </a> 
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar blue-bg navbar-static-top"> 
      <!-- Sidebar toggle button-->
      <ul class="nav navbar-nav pull-left">
        <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
      </ul>
      <div class="pull-left search-box">
        <form action="#" method="get" class="search-form">
          <div class="input-group">
            <input name="search" class="form-control" placeholder="Search..." type="text">
            <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> </button>
            </span></div>
        </form>
        <!-- search form --> </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu p-ph-res">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('template/img/img1.jpg') }}" class="user-image" alt="User Image">
            </a>
            <ul class="dropdown-menu">
             
              <li><a href="#"><i class="icon-profile-male"></i> My Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar"> 
      <style>
        .navbar-custom-menu .user-menu>a{display:flex;align-items:center;gap:10px}
        .navbar-custom-menu .user-menu .user-image{width:34px;height:34px;border-radius:999px;object-fit:cover;border:2px solid rgba(255,255,255,.35);box-shadow:0 10px 22px rgba(0,0,0,.18);margin-top:-2px}
        .main-header .logo.blue-bg{background:linear-gradient(135deg,#0ea5e9 0%,#6366f1 100%)}
        .navbar.blue-bg{background:linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%)}
        .main-sidebar{background:linear-gradient(180deg,#0b1220 0%,#0f1b2d 60%,#0b1220 100%);box-shadow:18px 0 45px rgba(2,6,23,.18);top:0;bottom:0;position:fixed}
        .sidebar{padding-top:10px;position:relative;min-height:100%;display:flex;flex-direction:column;height:100%}
        .sidebar .sidebar-menu{padding:8px 10px;flex:1 1 auto;overflow-y:auto;overflow-x:hidden}
        .sidebar-menu>li>a{display:flex;align-items:center;gap:10px;padding:10px 12px;margin:6px 0;border-radius:14px;color:rgba(255,255,255,.82);background:transparent;transition:background .18s ease,transform .18s ease,color .18s ease}
        .sidebar-menu>li>a:hover{background:rgba(255,255,255,.10);color:#fff;transform:translateX(2px)}
        .sidebar-menu>li.active>a{background:linear-gradient(135deg,rgba(14,165,233,.90),rgba(99,102,241,.90));color:#fff;box-shadow:0 10px 24px rgba(2,132,199,.22)}
        .sidebar-menu>li>a>.fa{width:18px;text-align:center;opacity:.95}
        .sidebar-menu>li>a>span{font-weight:600;letter-spacing:.2px}
        .sidebar-menu .treeview-menu{padding-left:18px;margin:6px 0 6px 6px;border-left:1px solid rgba(255,255,255,.12)}
        .sidebar-menu .treeview-menu>li>a{padding:8px 12px;margin:4px 0;border-radius:12px;color:rgba(255,255,255,.75);transition:background .18s ease,color .18s ease}
        .sidebar-menu .treeview-menu>li>a:hover{background:rgba(255,255,255,.08);color:#fff}
        .sidebar-menu .treeview>a>.pull-right-container{margin-left:auto}
        .sidebar-menu .treeview>a>.pull-right-container .fa-angle-left{opacity:.8}
        .content-wrapper{background:#f6f8fc}
        .content{padding:18px}
        .card{border-radius:16px;border:1px solid rgba(15,23,42,.08);box-shadow:0 14px 34px rgba(15,23,42,.06)}
        .card .card-header{border-top-left-radius:16px;border-top-right-radius:16px}
        .main-footer{background:transparent;border-top:0}
        .sidebar-footer{margin:12px 10px 10px;padding:12px;border-radius:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);flex:0 0 auto}
        .sidebar-footer .sf-top{display:flex;align-items:center;gap:12px}
        .sidebar-footer .sf-avatar{width:44px;height:44px;border-radius:999px;overflow:hidden;border:2px solid rgba(255,255,255,.20);box-shadow:0 10px 22px rgba(0,0,0,.18);flex:0 0 auto}
        .sidebar-footer .sf-avatar img{width:100%;height:100%;object-fit:cover;display:block}
        .sidebar-footer .sf-name{color:#fff;font-weight:800;line-height:1.1}
        .sidebar-footer .sf-sub{margin-top:4px;color:rgba(255,255,255,.70);font-size:12px}
        .sidebar-footer .sf-actions{margin-top:12px;display:flex;gap:8px}
        .sidebar-footer .sf-btn{flex:1 1 auto;display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:8px 10px;border-radius:12px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.14);color:#fff}
        .sidebar-footer .sf-btn:hover{background:rgba(255,255,255,.14);color:#fff}
      </style>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active"> <a href="{{ route('admin.home') }}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
         <li class="treeview"> <a href="#"> <i class="fa fa-table"></i> <span>Master Data</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.jalan.index') }}">Ruas Jalan</a></li>
            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li><a href="{{ route('admin.tahun.index') }}">Tahun</a></li>
            <li><a href="{{ route('admin.pejabat.index') }}">Pejabat</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-edit"></i> <span>Pengelola</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.pengelola.perorangan') }}">Perorangan</a></li>
            <li><a href="{{ route('admin.pengelola.badan') }}">Badan</a></li>
            <li><a href="{{ route('admin.pengelola.jukir') }}">Juru Parkir</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-map-marker"></i> <span>Lokasi Parkir</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.titik.index') }}">Titik Parkir</a></li>
            <li><a href="{{ route('admin.titikjukir.index') }}">Titik Juru Parkir</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-bullhorn"></i> <span>Pengaduan</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.pengaduan.index') }}">dari Masyarakat</a></li>
            <li><a href="{{ route('admin.pengaduan_jukir.index') }}">untuk Juru Parkir</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-print"></i> <span>Cetak SK</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.cetak.perorangan') }}">Pengelola Perorangan</a></li>
            <li><a href="{{ route('admin.cetak.badan') }}">Pengelola Badan</a></li>
          </ul>
        </li>

      </ul>
      <div class="sidebar-footer">
        <div class="sf-top">
          <div class="sf-avatar">
            <img src="{{ asset('template/img/img1.jpg') }}" alt="User">
          </div>
          <div>
            <div class="sf-name">{{ session('nama', 'Admin') }}</div>
            <div class="sf-sub">Tahun aktif: {{ session('tahun', date('Y')) }}</div>
          </div>
        </div>
        <div class="sf-actions">
          <a class="sf-btn" href="#"><i class="fa fa-cog"></i> Setting</a>
          <a class="sf-btn" href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a>
        </div>
      </div>
    </div>
    <!-- /.sidebar --> 
  </aside>
  
  @yield('content')

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs"></div>
    Copyright © {{ date('Y') }} Dinhub Banjarnegara. All rights reserved.</footer>
</div>
<!-- ./wrapper --> 

<!-- jQuery 3 --> 

<!-- v4.0.0-alpha.6 --> 
<script>
(function(w){
  w._tetherTemp = {define:w.define, exports:w.exports, module:w.module};
  w.define = undefined;
  w.exports = undefined;
  w.module = undefined;
})(window);
</script>
<script src="{{ asset('assets/js/tether.min.js') }}"></script>
<script>
(function(w){
  var t = w._tetherTemp || {};
  if (typeof w.Tether === 'undefined' && t.module && t.module.exports) {
    w.Tether = t.module.exports;
  }
  w.define = t.define;
  w.exports = t.exports;
  w.module = t.module;
  w._tetherTemp = undefined;
})(window);
</script>
<script>
if (typeof window.Tether === 'undefined') {
  window.Tether = function () {
    this.position = function () {};
    this.destroy = function () {};
  };
}
</script>
<script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script> 

<!-- template --> 
<script src="{{ asset('template/js/niche.js') }}"></script>

<!-- DataTable --> 
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('template/plugins/datatables/dataTables.bootstrap.min.js') }}"></script> 
<script>
  $(function () {
    $('#datatable').DataTable()
  });
    $(function () {
    $('#datatable2').DataTable()
  });
</script> 

<script>
  $(function () {
    var isDashboard = {{ json_encode(request()->segment(2) === 'home') }};
    if (!isDashboard && ($('#datatable').length || $('#datatable2').length)) {
      $('.content-header.sty-one').hide();
    }
  });
</script>

<script src="{{ asset('assets/pengelola/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/pengelola/plugins/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script>
  $(function() {
    // Store initial history state
    history.replaceState({url: window.location.href}, document.title, window.location.href);

    // Intercept clicks on sidebar menu links
    $(document).on('click', '.sidebar-menu a, .users-actions-td a, .tp-actions-td a, .skp-actions-td a, .skb-actions-td a, .pm-actions-td a, .pj-actions-td a, .card-body a', function(e) {
        var url = $(this).attr('href');
        
        // Skip external, empty, or javascript links
        if (!url || url === '#' || url.startsWith('javascript:') || url.startsWith('mailto:') || url.startsWith('tel:') || $(this).attr('target') === '_blank') {
            return;
        }
        
        // Only PJAX local admin routes
        if (url.indexOf(window.location.origin) !== 0 && url.indexOf('/') !== 0) {
            return;
        }

        e.preventDefault();
        loadPage(url, true);
    });

    function loadPage(url, pushState) {
        // Fade out content wrapper to signal loading
        $('.content-wrapper').css('opacity', '0.4');
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                // Keep scripts from executing automatically during parse
                var tempDom = $('<div/>').append($.parseHTML(response, document, true));
                var newTitle = tempDom.find('title').text();
                var contentWrapper = tempDom.find('.content-wrapper');
                
                if (contentWrapper.length) {
                    // Extract and remove scripts to prevent automatic execution by jQuery
                    var scripts = contentWrapper.find('script');
                    scripts.remove();
                    
                    var newContent = contentWrapper.html();
                    document.title = newTitle;
                    
                    // Insert content and restore opacity
                    $('.content-wrapper').html(newContent).css('opacity', '1');
                    
                    if (pushState) {
                        history.pushState({url: url}, newTitle, url);
                    }
                    
                    // Update active sidebar menu highlighting
                    $('.sidebar-menu li').removeClass('active');
                    $('.sidebar-menu .treeview-menu').hide();
                    
                    var activeLink = $('.sidebar-menu a[href="' + url + '"]');
                    if (activeLink.length) {
                        activeLink.closest('li').addClass('active');
                        var parentTreeView = activeLink.closest('.treeview');
                        parentTreeView.addClass('active');
                        parentTreeView.find('.treeview-menu').show();
                    }
                    
                    // Execute scripts manually now that the DOM element is fully appended and ready
                    scripts.each(function() {
                        var scriptText = $(this).text();
                        if (scriptText) {
                            try {
                                $.globalEval(scriptText);
                            } catch (e) {
                                console.error("Script execution error: ", e);
                            }
                        }
                    });
                    
                    // Reinitialize script plugins (like Datatables)
                    reinitializeScripts();
                } else {
                    window.location.href = url;
                }
            },
            error: function() {
                window.location.href = url;
            }
        });
    }

    // Handle back and forward browser buttons
    window.onpopstate = function(e) {
        if (e.state && e.state.url) {
            loadPage(e.state.url, false);
        } else {
            window.location.reload();
        }
    };

    function reinitializeScripts() {
        // Reinitialize DataTables
        if ($.fn.DataTable) {
            if ($.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable().destroy();
            }
            if ($('#datatable').length) {
                $('#datatable').DataTable();
            }
            if ($.fn.DataTable.isDataTable('#datatable2')) {
                $('#datatable2').DataTable().destroy();
            }
            if ($('#datatable2').length) {
                $('#datatable2').DataTable();
            }
        }
        
        // Hide content-header on tables
        var isDashboard = window.location.pathname.indexOf('/home') !== -1;
        if (!isDashboard && ($('#datatable').length || $('#datatable2').length)) {
            $('.content-header.sty-one').hide();
        }
    }
  });
</script>
</body>
</html>
