
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $page_name }} | {{ $app_title }}</title>

  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/styles/styles.css') }}">
  <link rel="shortcut icon" href="{{ asset($app_favicon) }}" type="image/x-icon">

</head>

<body class="hold-transition layout-top-nav">
    
    <nav class="main-header navbar navbar-expand-md navbar-light bg-primary">
        <div class="container">

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