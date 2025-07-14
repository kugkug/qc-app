   
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


<div class="row mt-3">
    <div class="col-md-12 text-center" style="font-size: 20px;">
        ENVIRONMENTAL SANITATION DIVISION
    </div>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center bg-primary text-white" style="font-size: 26px;">
            DIGITAL SANITARY PERMIT
    </div>
    <div class="col-md-3"></div>
</div>


<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="" id="div-id-data">
            <div class="row mt-1">
                <div class="col-md-3 text-right">Name of Establishment: </div>
                {{-- <div class="col-md-10 text-center border-bottom">{{ ucwords(strtolower($application['user']['lastname'].", ".$application['user']['firstname'])) }}</div> --}}
            </div>
            <div class="row mt-1">
                <div class="col-md-3 text-right">Address: </div>
                <div class="col-md-9 text-center border-bottom">
                    {{-- {{ ucwords(strtolower($application['user']['street'] ." ".$application['user']['barangay_id']." ".$application['user']['address'])) }} --}}
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-3 text-right">Owner: </div>
                <div class="col-md-9 text-center border-bottom"></div>
            </div>
            <div class="row mt-1">
                <div class="col-md-3 text-right">Nature of Business: </div>
                <div class="col-md-9 text-center border-bottom"></div>
            </div>
        
            <div class="row mt-1">
                <div class="col-md-3 text-right">MP Number: </div>
                <div class="col-md-3 text-center border-bottom"></div>
                <div class="col-md-3 text-right">Official Receipt No.: </div>
                <div class="col-md-3 text-center border-bottom">--</div>
            </div>
            <div class="row mt-1">
                <div class="col-md-3 text-right">Date of Issuance: </div>
                <div class="col-md-3 text-center border-bottom"></div>
                <div class="col-md-3 text-right">Date of Payment: </div>
                <div class="col-md-3 text-center border-bottom">--</div>
            </div>
            <div class="row mt-1">
                <div class="col-md-3 text-right">Date of Expiration: </div>
                <div class="col-md-3 text-center border-bottom"></div>
                <div class="col-md-3 text-right">Ammount Paid: </div>
                <div class="col-md-3 text-center border-bottom">--</div>
            </div>
        </div>
    </div>
    <div class="col-md-4" id="div-back-id"></div>
</div>

    
