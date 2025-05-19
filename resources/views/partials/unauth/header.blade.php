
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
    <title>{{ $page_name }} | {{ $app_title }}</title>

    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/confirm/css/jquery-confirm.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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
                        <a href="/about-us" class="nav-link">
                            <i class="fa fa-info"></i>
                            About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact-us" class="nav-link">
                            <i class="fa fa-phone"></i> 
                            Contact Us
                        </a>
                    </li>
                </ul>
        
                <!-- SEARCH FORM -->
                
            </div>
    

    
            <!-- SEARCH FORM -->
            
        </div>
    
      
        </div>
      </nav>
    <nav class="main-header navbar navbar-expand-md navbar-light bg-primary-system z-0">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('assets/images/system/qcid_icon.png') }}" alt="QC Logo" class="brand-image" style="width: 170px !important;">
                <span class="brand-text font-weight-strong text-white">{{ $app_title }}</span>
            </a>

        </div>
    </nav>
    <div class="content-wrapper bg-system-image pb-4">
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