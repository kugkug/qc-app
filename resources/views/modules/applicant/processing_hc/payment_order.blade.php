@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Order of Payment" xpath='/applicant'/> --}}
    @include('components.timeline')
</div>

@include('partials.applicant.footer')