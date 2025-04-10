@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Certificate Issuing" xpath='/applicant'/> --}}
    @include('components.timeline')

    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h3 class="card-title">
                Health Card Identification
            </h3>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Staus</th>
                        <th class="w-25">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mon, 21 Oct 2024</td>
                        <td>Health Card Approved</td>
                        <td>
                            <a href="/applicant/processing/health-id-card" class="btn btn-outline-primary btn-flat">VIEW DIGITAL HEALTH CARD</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>

    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h3 class="card-title">
                Laboratory Certificates
            </h3>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>Laboratory</th>
                        <th class="w-25">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fecalysis/Stool Exam Result</td>
                        <td>
                            <a href="/applicant/processing/certificate?type=stool" class="btn btn-outline-primary btn-flat">VIEW</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Sputum/Chest X-ray Exam Result</td>
                        <td>
                            <a href="/applicant/processing/certificate?type=sputum_xray" class="btn btn-outline-primary btn-flat">VIEW</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@include('partials.applicant.footer')