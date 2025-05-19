<link rel="stylesheet" href="{{ public_path('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
{{-- <link rel="stylesheet" href="{{ public_path('assets/css/styles.css') }}"> --}}
@php
    $qcid_icon = base64_encode(file_get_contents(public_path('assets/images/system/qcid_icon.png')));
    $qc_health_log = base64_encode(file_get_contents(public_path('assets/images/system/qc_health_logo.png')));
@endphp
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 py-5 px-3">
        <div class="row">
            <div class="col-md-4">
                <img src="data:image/png; base64, {{ $qcid_icon }}" alt="QC Logo" class="brand-image" style="width: 150px !important;">
            </div>
            <div class="col-md-4">
                <span class="brand-text text-center">
                    <p style="font-size: 20px;" class="">
                        Republic of the Philippines<br />
                        Quezon City<br />
                        Quezon City Health Department<br />
                    </p>
                </span>
            </div>
            <div class="col-md-4 text-right">
                <img src="data:image/png; base64, {{ $qc_health_log }}" alt="QC Logo" class="brand-image" style="width: 120px !important;">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 text-center"></div>
            <div class="col-md-4">
                <span class="brand-text text-center">
                    <p style="font-size: 20px;" class="">
                        Order of Payment
                    </p>
                    <p>
                        Health Certificate
                    </p>
                </span>
            </div>
            <div class="col-md-4 text-center"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <p>
                    The City Treasurer Bldg.<br />
                    Miscellaneous Section
                </p>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <p>
                    @php
                        $name = ucwords(strtolower($application['user']['lastname'].", ".$application['user']['firstname']));
                    @endphp
                    Sir/Madam<br />
                    Please accept payment from Mr./Ms. 
                    <font class="font-weight-bold"> {{ $name }} </font> the amount of 
                    <font class="font-weight-bold"> {{ $payment_details['total']}} </font> computed as follows:
                </p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($payment_details['details'])
                            @foreach ($payment_details['details'] as $detail)
                                <tr>
                                    <td>
                                        {{ $detail['description'] }}
                                    </td>
                                    <td class="text-right">
                                        {{ $detail['amount'] }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-right text-bold">
                                    TOTAL
                                </td>
                                <td class="text-right text-bold">
                                    {{ number_format($payment_details['total'], 2, ".", ",") }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ config('system.payment_signatory') }}<br />
                Authorize Personel
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <font class="font-weight-bold">Reference No.: </font>
                <font class="font-weight-bolder text-decoration-underline">{{ $payment_details['ref_no'] }}</font>
            </div>
        </div>
    </div>
</div>