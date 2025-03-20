@if($xtype == 'barangays')

    <select class="form-control rounded-0" data-key="BaranggayId">
        <option value="" selected="selected">- Select Barangay -</option>
        @foreach ($global_dropdowns['barangays'] as $brgy)
            <option value="{{$brgy['id']}}">{{$brgy['baranggay']}}</option>
        @endforeach
    </select>

@elseif($xtype == 'classifications')

    <select class="form-control rounded-0" data-key="ClassificationId">
        <option value="" selected="selected">- Select Classification -</option>
        @foreach ($global_dropdowns['classifications'] as $item)
            <option value="{{$item['id']}}">{{$item['classification']}}</option>
        @endforeach
    </select>

@elseif($xtype == 'application_types')

    <select class="form-control rounded-0" data-key="ApplicationType">
        <option value="" selected="selected">- Select Application Type -</option>
        @foreach ($global_dropdowns['application_types'] as $item)
            <option value="{{$item['id']}}">{{$item['application']}}</option>
        @endforeach
    </select>

@elseif($xtype == 'industries')

    <select class="form-control rounded-0" data-key="Industry">
        <option value="" selected="selected">- Select Industry -</option>
        @foreach ($global_dropdowns['industries'] as $item)
            <option value="{{$item['id']}}">{{$item['industry']}}</option>
        @endforeach
    </select>

@elseif($xtype == 'sub_industries')

    <select class="form-control rounded-0" data-key="SubIndustry">
        <option value="" selected="selected">- Select Sub Industry -</option>
        @foreach ($global_dropdowns['sub_industries'] as $item)
            <option value="{{$item['id']}}">{{$item['sub_industry']}}</option>
        @endforeach
    </select>
@else
    <select class="form-control rounded-0">
        <option value="" selected="selected">- Select -</option>
        
    </select>
@endif
