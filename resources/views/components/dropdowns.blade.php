@if($xtype == 'barangays')

    <select class="form-control rounded-0" data-key="BaranggayId" data="req">
        <option value="" selected="selected">- Select Barangay -</option>
        @foreach ($global_dropdowns['barangays'] as $brgy)
            @php
                $selected = $brgy['id'] == $xselected ? " selected" : "";
            @endphp
            <option {{ $selected }} value="{{$brgy['id']}}">{{$brgy['baranggay']}}</option>
        @endforeach
    </select>
@elseif($xtype == 'civil_statuses')

    <select class="form-control rounded-0" data-key="CivilStatusId" data="req">
        <option value="" selected="selected">- Select Civil Status -</option>
        @foreach ($global_dropdowns['civil_statuses'] as $civil_status)
            @php
                $selected = $civil_status['id'] == $xselected ? " selected" : "";
            @endphp
            <option value="{{$civil_status['id']}}" {{ $selected }}>{{$civil_status['civil_status']}}</option>
        @endforeach
    </select>
@elseif($xtype == 'classifications')

    <select class="form-control rounded-0" data-key="ClassificationId" data="req">
        @foreach ($global_dropdowns['classifications'] as $item)
            <option value="{{$item['id']}}">{{$item['classification']}}</option>
        @endforeach
    </select>

@elseif($xtype == 'application_types')

    <select class="form-control rounded-0" data-key="ApplicationTypeId" data="req">
        <option value="" selected="selected">- Select Application Type -</option>
        @foreach ($global_dropdowns['application_types'] as $item)
            <option value="{{$item['id']}}">{{$item['application']}}</option>
        @endforeach
    </select>

@elseif($xtype == 'industries')

    <select class="form-control rounded-0" data-key="IndustryId" data-select-trigger="sub-industry" data="req">
        <option value="" selected="selected">- Select Industry -</option>
        @foreach ($global_dropdowns['industries'] as $item)
            <option value="{{$item['id']}}">{{$item['industry']}}</option>
        @endforeach
    </select>

@elseif($xtype == 'sub_industries')

    <select class="form-control rounded-0" data-key="SubIndustryId" data-select-trigger="business-line" disabled="" data="req">
        {{-- @foreach ($global_dropdowns['sub_industries'] as $item)
            <option value="{{$item['id']}}">{{ $item['industry_id'] }} | {{$item['sub_industry']}} </option>
        @endforeach --}}
    </select>

@elseif($xtype == 'business_lines')

    <select class="form-control rounded-0" data-key="BusinessLineId" disabled="" data="req">
        {{-- @foreach ($global_dropdowns['sub_industries'] as $item)
            <option value="{{$item['id']}}">{{ $item['industry_id'] }} | {{$item['sub_industry']}} </option>
        @endforeach --}}
    </select>

    
@elseif($xtype == 'genders')
    @php
        $male_selected = $xselected == "male" ? " selected" : "";
        $female_selected = $xselected == "female" ? " selected" : "";
        
    @endphp
    <select class="form-control rounded-0" data-key="Sex" data="req">
        <option value="" selected="selected">- Select Gender -</option>
        <option value="female" {{ $female_selected }}>Female</option>
        <option value="male" {{ $male_selected }}>Male</option>
    </select>

@else
    <select class="form-control rounded-0">
        <option value="" selected="selected">- Select -</option>
        
    </select>
@endif
