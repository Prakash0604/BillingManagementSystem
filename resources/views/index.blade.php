<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Billing Management System</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/billinglogo.jpg') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendors/images/billinglogo.jpg') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendors/images/billinglogo.jpg') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap.min.js" integrity="sha512-F0E+jKGaUC90odiinxkfeS3zm9uUT1/lpusNtgXboaMdA3QFMUez0pBmAeXGXtGxoGZg3bLmrkSkbK1quua4/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- Latest DataTable CDN Start --}}
    <!-- DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
    {{-- Latest DataTable CDN End --}}


	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="{{ asset('jqueryfunction/setup.js') }}"></script>
    <script src="{{ asset('jqueryfunction/billing.js') }}"></script>
    {{-- Data Table CDN --}}


</head>
<body class="bg-white">
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
			</div>
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="{{ asset('vendors/images/photo1.jpg') }}" alt="">
						</span>
						<span class="user-name">{{ Auth::user()->name }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="{{ route('logout') }}"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{ route('dashboard') }}">
				<img src="{{ asset('vendors/images/logobilling.png') }}" alt="" class="dark-logo">
				<img src="{{ asset('vendors/images/logobilling.png') }}" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="bi bi-house-fill"></span><span class="mtext">Home</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('batch_type') }}">Batch Type</a></li>
							<li><a href="{{ route('setup') }}">Setup</a></li>
                            <li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<i class="bi bi-person"></i><span class="mtext">Students</span>
								</a>
								<ul class="submenu child">
									<li><a href="{{ route('students.create') }}">Add Student</a></li>
									<li><a href="{{ route('students.index') }}">Student Lists</a></li>
									<li><a href="{{ route('getImportExport') }}">Import/Export Students</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="bi bi-receipt"></span><span class="mtext">Billing</span>
						</a>
						<ul class="submenu">
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="bi bi-sliders"></span><span class="mtext">Setup</span>
								</a>
								<ul class="submenu child">
									<li><a href="{{ route('particular') }}">Particular</a></li>
									<li><a href="{{ url('billing/fee_structure/create') }}">Fee Structure</a></li>
								</ul>
							</li>
                            <li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="bi bi-sliders"></span><span class="mtext">Generate</span>
								</a>
								<ul class="submenu child">
									<li><a href="javascript:;">Bill</a></li>
									<li><a href="javascript:;">Receipt</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="invoice.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">Invoice</span>
						</a>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="bi bi-bar-chart-line-fill  "></span><span class="mtext">Report</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('batchWiseReport') }}">Batch Wise Student Report</a></li>
							<li><a href="">Third Party Plugins</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
        @yield('content')
	</div>
    <div class="footer">
        <div class="footer-wrap pd-20 card-box" style="margin-top:500px">
            Billing Management System | All right reserved by <a href="" target="_blank">Jay Prakash Chaudhary</a>
        </div>

    </div>
	<!-- js -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    {{-- <script>
        let table = new DataTable('#myTable');
    </script> --}}
    @stack('scripts')
</body>
</html>
