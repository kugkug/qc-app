   
<link rel="stylesheet" href="{{ public_path('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ public_path('assets/styles/styles.css') }}">

<div class="row">
    <div class="col-md-4" id="div-front-id">
        <img src="{{ public_path('assets/images/system/people_corner_icon.jpg') }}" alt="" >
        <div class="" id="div-id-data">
            <div class="row mt-1">
                <div class="col-md-2">NAME: </div>
                <div class="col-md-10 text-center border-bottom">{{ ucwords(strtolower($application['user']['lastname'].", ".$application['user']['firstname'])) }}</div>
            </div>
            <div class="row mt-1">
                <div class="col-md-1">AGE: </div>
                <div class="col-md-2 text-center border-bottom">{{ $application['user']['suffixname'] }}</div>
                <div class="col-md-1">SEX: </div>
                <div class="col-md-2 text-center border-bottom">{{ $application['user']['sex'] }}</div>
                <div class="col-md-3">NATIONALITY: </div>
                <div class="col-md-3 text-center border-bottom">{{ $application['user']['nationality'] }}</div>
            </div>
            <div class="row mt-1">
                <div class="col-md-4">HOME ADDRESS: </div>
                <div class="col-md-8 text-center border-bottom">
                    {{ ucwords(strtolower($application['user']['street'] ." ".$application['user']['barangay_id']." ".$application['user']['address'])) }}
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-3">OCCUPATION: </div>
                <div class="col-md-3 text-center border-bottom">{{ $application['user']['occupation'] }}</div>
                <div class="col-md-2">INDUSTRY: </div>
                <div class="col-md-4 text-center border-bottom">{{ $application['industry_id'] }}</div>
            </div>
            <div class="row mt-1">
                <div class="col-md-2">SPUTUM/CXR: </div>
                <div class="col-md-4 text-center border-bottom">NEGATIVE</div>
                <div class="col-md-2">STOOL: </div>
                <div class="col-md-4 text-center border-bottom">NEGATIVE</div>
            </div>
            <div class="row mt-1">
                <div class="col-md-4">REGISTRATION NO.: </div>
                <div class="col-md-8 text-center border-bottom">{{ $application['application_ref_no'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4" id="div-back-id"></div>
</div>