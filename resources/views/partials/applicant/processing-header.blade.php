
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
  <title>{{ $page_name }} | {{ $app_title }}</title>

  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/confirm/css/jquery-confirm.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> 
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> 
  <link rel="stylesheet" href="{{ asset('assets/styles/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/styles/overrides.css') }}">
  <link rel="shortcut icon" href="{{ asset($app_favicon) }}" type="image/x-icon">

</head>

<body class="hold-transition layout-top-nav">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
          <a href="/applicant/home" class="navbar-brand">
            <img src="{{ asset('assets/images/system/qc_services_logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="width: 100px;">
            {{-- <span class="brand-text font-weight-light">{{ $app_name }}</span> --}}
          </a>
    
          <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/applicant/home" class="nav-link">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/applicant/health_certificate" class="nav-link">
                        <i class="fa fa-certificate"></i> 
                        Health Certificate
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/applicant/sanitary_permit" class="nav-link">
                        <i class="fas fa-stamp"></i>
                        Sanitary Permit
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/complaint" class="nav-link">
                        <i class="fas fa-file-contract"></i>
                        Complain
                    </a>
                </li>
            </ul>
    
            <!-- SEARCH FORM -->
            
          </div>
    
          <!-- Right navbar links -->
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item">
              <a class="nav-link btn btn-primary text-white btn-sm font-weight-bold" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-spinner"></i> Progress
              </a>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
              
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i> 4 new messages
                  <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-users mr-2"></i> 8 friend requests
                  <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-file mr-2"></i> 3 new reports
                  <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">My Account</span>
                
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-user-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-user-shield"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-sign-out-alt"></i> Log out                
                </a>
                
              </div>
            </li>
            
          </ul>
        </div>
      </nav>
    
    <section class="bg-primary-system">
        <div class="container d-flex justify-content-between align-items-center py-4">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('assets/images/system/qcid_icon.png') }}" alt="QC Logo" class="brand-image" style="width: 170px !important;">
            </a>
            <span class="brand-text font-weight-strong text-white text-center">
                <p style="font-size: 22px;" class="font-weight-bold">
                    Republic of the Philippines<br />
                    Quezon City<br />
                    Quezon City Health Department
                </p>
            </span>

            <img src="{{ asset('assets/images/system/qc_health_logo.png') }}" alt="QC Health Logo" class="brand-image" style="width: 140px !important;">

        </div>
    </section>
    <div class="content-wrapper pb-4">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0"> Top Navigation <small>Example 3.0</small></h1> --}}
                    </div>
                    <div class="col-sm-6">
                    {{-- 
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Layout</a></li>
                            <li class="breadcrumb-item active">Top Navigation</li>
                        </ol> 
                    --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content">