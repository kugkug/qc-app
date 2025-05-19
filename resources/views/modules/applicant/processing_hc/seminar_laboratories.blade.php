@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="HIV Seminar & Laboratories" xpath='/applicant' /> --}}
    @include('components.timeline')

    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-0 shadow-lg">
                <input type="hidden" value="{{$ref_no}}">
                <div class="card-body text-center" style="height: 600px;">
                    <iframe 
                        id="iframe-player"
                        class="w-100 h-100 iframe" 
                        src="https://www.youtube.com/embed/cSNaBui2IM8?autoplay=1&mute=0&enablejsapi=1" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen=""
                        >
                    </iframe>                
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.applicant.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="https://www.youtube.com/iframe_api"></script>
<script src="{{ asset('assets/scripts/modules/health/seminars.js') }}"></script>