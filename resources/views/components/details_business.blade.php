


<div class="row">
    
    <div class="col-md-6">
        <dl>
            <dt class="font-weight-normal text-muted">Type</dt>
            <dd class="font-weight-bold">{{ ucwords(strtolower( $business['application_type']['application'])) }}</dd>
        </dl>
    </div>
    
    <div class="col-md-6">
        <dl>
            <dt class="font-weight-normal text-muted">Industry</dt>
            <dd class="font-weight-bold">{{ ucwords(strtolower( $business['industry']['industry'])) }}</dd>
        </dl>
    </div>
    
</div>
    

<div class="row">
    <div class="col-md-6">
        <dl>
            <dt class="font-weight-normal text-muted">Sub-Industry</dt>
            <dd class="font-weight-bold border-bottom border-dark text-truncate">
                {{ ucwords(strtolower( $business['sub_industry']['sub_industry'])) }}
            </dd>
        </dl>
    </div>

    <div class="col-md-6">
        <dl>
            <dt class="font-weight-normal text-muted">Sub-Industry</dt>
            <dd class="font-weight-bold border-bottom border-dark text-truncate">
                {{ ucwords(strtolower( $business['business_line_text'])) }}
            </dd>
        </dl>
    </div>
</div>
