
<h3 class="text-center font-weight-bold">{{ $xtitle }}</h3>

<div class="display-horizontal">
    <div id="crumbs-container">
        @php
            if ($xpath == '/business') {
                $global_timelines = array_filter($global_timelines, fn($tl) => $tl['timeline'] !== 'HIV Seminar & Laboratories');
            }

            $cntr = 1;
            $timeline_length = sizeof($global_timelines);

            if ($histories) {
                $last_timeline = $histories[ sizeOf($histories) ];
            } else {
                $last_timeline = [];
            }
        @endphp
        @foreach ($global_timelines as $timeline)
            @php
                $font_weight_bold = ($timeline['timeline'] == $xname) ? "font-weight-bold" : "";
                // completed completed-date
                // inprogress

                $class = "";
                $date_class = "";
                $status = "";
                $date = "";
                $link = "javascript:void(0)";
                if (array_key_exists($timeline['id'], $histories)) {
                    $class = "completed";
                    $status = "Completed";
                    $date = date('m/d/Y', strtotime($histories[$timeline['id']]['updated_at']));

                    $link = $xpath.$timeline['link']."/".$xrefno;
                }

                if ($last_timeline) {
                    $latest_timeline_id = $last_timeline['timeline_look_up_id'];
                    $next_timeline_id = $latest_timeline_id + 1;
                    
                    if ($next_timeline_id == $timeline['id']) {
                        $class = "inprogress";
                        $status = "In-Progress";
                        $date = date('m/d/Y');
                    }
                }

            @endphp
            
            <div class="crumb-holder">
                <div class="crumb-label">
                    <a href="{{ $link }}" class="{{ $font_weight_bold }}">{{$timeline['timeline']}}</a>
                </div>
                <div class="crumb-marker {{ $class }}"></div>
                <div class="crumb-details">
                    <div class="mgb-4 mgt-4">{{ $date }}</div>
                    <div class="crumb-status {{ $class }}">{{ $status }}</div>
                </div>
            </div>
            @php
                if ($cntr < $timeline_length) {
                    echo '<div class="crumb-bridge '.$class.' "></div>';
                    $cntr++;
                }
            @endphp

        @endforeach

    </div>
</div>
<div class="row mb-2 d-lg-none d-xl-none">
    <div class="col-md-12">
        <button 
            class="btn btn-primary btn-block btn-flat"
            data-widget="control-sidebar" 
            data-slide="true" 
            href="#" 
            role="button"
        >
            VIEW PROGRESS
        </button>
    </div>
</div>

<aside class="control-sidebar control-sidebar-light shadow-lg">
    <!-- Control sidebar content goes here -->
    <div class="p-3 control-sidebar-content">
        @php
            $cntr = 1;
            $timeline_length = sizeof($global_timelines);
        @endphp
        @foreach ($global_timelines as $timeline)
            @php
                $font_weight_bold = ($timeline['timeline'] == $xname) ? "font-weight-bold" : "";
            @endphp

            <div class="mb-1"><span>{{ $timeline['timeline'] }}</span></div>
        @endforeach
    </div>
 </aside>