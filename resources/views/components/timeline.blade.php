
<h3 class="text-center font-weight-bold">{{ $xtitle }}</h3>

<div class="display-horizontal">
    <div id="crumbs-container">
        @php
            $cntr = 1;
            $timeline_length = sizeof($global_timelines);
        @endphp
        @foreach ($global_timelines as $timeline)
            <div class="crumb-holder">
                <div class="crumb-label">
                    <a href="applicant/process/application-form">{{$timeline['timeline']}}</a>
                </div>
                <div class="crumb-marker completed"></div>
                <div class="crumb-details">
                    <div class="mgb-4 mgt-4 completed-date">Date: 03/09/2025</div>
                    <div class="crumb-status completed">Completed</div>
                </div>
            </div>
            @php
                if ($cntr < $timeline_length) {

                    echo '<div class="crumb-bridge completed"></div>';
                    $cntr++;

                }
            @endphp

        @endforeach

    </div>
</div>

{{-- <div class="display-horizontal">
    <div id="crumbs-container">
        <div class="crumb-holder">
            <div class="crumb-label">
                <a href="applicant/process/upload-requirements">Application Form</a>
            </div>
            <div class="crumb-marker completed"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">Date: 03/09/2025</div>
                <div class="crumb-status completed">Completed</div>
            </div>
        </div>

        <div class="crumb-bridge completed"></div>

        <div class="crumb-holder">
            <div class="crumb-label">
                <a aria-current="page" class="active-label" href="/qce/ihc/requirements-upload">Upload Requirements</a>
            </div>
            <div class="crumb-marker inprogress"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">
                    <span>&nbsp;</span>
                </div>
                <div class="crumb-status inprogress">In Progress</div>
            </div>
        </div>
        
        <div class="crumb-bridge"></div>

        <div class="crumb-holder">
            <div class="crumb-label">
                <div>Requirements Validation</div>
            </div>
            <div class="crumb-marker notstarted"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">
                    <span>&nbsp;</span>
                </div>
                <div class="crumb-status notstarted"></div>
            </div>
        </div>
        
        <div class="crumb-bridge notstarted"></div>
        
        <div class="crumb-holder">
            <div class="crumb-label">
                <div>Order of Payment</div>
            </div>
            <div class="crumb-marker notstarted"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">
                    <span>&nbsp;</span>
                </div>
                <div class="crumb-status notstarted"></div>
            </div>
        </div>
        
        <div class="crumb-bridge notstarted"></div>
        
        <div class="crumb-holder">
            <div class="crumb-label">
                <div>Payment Validation</div>
            </div>
            <div class="crumb-marker notstarted"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">
                    <span>&nbsp;</span>
                </div>
                <div class="crumb-status notstarted"></div>
            </div>
        </div>
        
        <div class="crumb-bridge notstarted"></div>
        
        <div class="crumb-holder">
            <div class="crumb-label">
                <div>HIV Seminar &amp; Laboratories</div>
            </div>
            <div class="crumb-marker notstarted"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">
                    <span>&nbsp;</span>
                </div>
                <div class="crumb-status notstarted"></div>
            </div>
        </div>
        
        <div class="crumb-bridge notstarted"></div>
        
        <div class="crumb-holder">
            <div class="crumb-label">
                <div>Head Approval</div>
            </div>
            <div class="crumb-marker notstarted"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">
                    <span>&nbsp;</span>
                </div>
                <div class="crumb-status notstarted"></div>
            </div>
        </div>
        
        <div class="crumb-bridge notstarted"></div>

        <div class="crumb-holder">
            <div class="crumb-label">
                <div>Certificate Issuing</div>
            </div>
            <div class="crumb-marker notstarted"></div>
            <div class="crumb-details">
                <div class="mgb-4 mgt-4 completed-date">
                    <span>&nbsp;</span>
                </div>
                <div class="crumb-status notstarted"></div>
            </div>
        </div>

    </div>
</div> --}}