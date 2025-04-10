
<link rel="stylesheet" href="{{ public_path('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
<div class="row mt-5">
    @php
        $qcid_icon = base64_encode(file_get_contents(public_path('assets/images/system/qcid_icon.png')));
        $qc_health_log = base64_encode(file_get_contents(public_path('assets/images/system/qc_health_logo.png')));
    @endphp

    <div class="col-md-4 text-center">
        <img src="data:image/png; base64, {{ $qcid_icon }}" alt="QC Logo" class="brand-image" style="width: 170px !important;">
    </div>
    <div class="col-md-4">
        <span class="brand-text text-center">
            <p style="font-size: 22px;" class="">
                Republic of the Philippines<br />
                Quezon City<br />
                Quezon City Health Department
            </p>
        </span>
    </div>
    <div class="col-md-4 text-center">
        <img src="data:image/png; base64, {{ $qc_health_log }}" alt="QC Logo" class="brand-image" style="width: 140px !important;">
    </div>
</div>
    
