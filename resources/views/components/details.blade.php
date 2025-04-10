<div class="row">
    <div class="col-md-12">
    
        <dl>
            <dt class="font-weight-normal text-muted">Full Name</dt>
            <dd class="font-weight-bold">{{ ucwords(strtolower( $user_info['lastname'] ." " .$user_info['firstname'] . ", ".$user_info['lastname'] ))}}</dd>
        </dl>
    </div>
    
</div>

<div class="row">
    <div class="col-md-4">
        <dl>
            <dt class="font-weight-normal text-muted">Classification</dt>
            <dd class="font-weight-bold">{{ ucwords(strtolower( $application['classification']['classification'])) }}</dd>
        </dl>
    </div>
    <div class="col-md-4">
        <dl>
            <dt class="font-weight-normal text-muted">Type</dt>
            <dd class="font-weight-bold">{{ ucwords(strtolower( $application['application_type']['application'])) }}</dd>
        </dl>
    </div>
    
    <div class="col-md-4">
        <dl>
            <dt class="font-weight-normal text-muted">Industry</dt>
            <dd class="font-weight-bold">{{ ucwords(strtolower( $application['industry']['industry'])) }}</dd>
        </dl>
    </div>
    
</div>
    

<div class="row">
    <div class="col-md-6">
        <dl>
            <dt class="font-weight-normal text-muted">Sub-Industry</dt>
            <dd class="font-weight-bold border-bottom border-dark text-truncate">
                {{ ucwords(strtolower( $application['sub_industry']['sub_industry'])) }}
            </dd>
        </dl>
    </div>
    <div class="col-md-6">
        <dl>
            <dt class="font-weight-normal text-muted">Business Line</dt>
            <dd class="font-weight-bold border-bottom border-dark text-truncate">
                {{ ucwords(strtolower( $application['business_line']['business_line'])) }}
            </dd>
        </dl>
    </div>
    
    
</div>

<div class="row">
    <div class="col-md-2">
        <dl>
            <dt class="font-weight-normal text-muted">Gender</dt>
            <dd class="font-weight-bold border-bottom border-dark">MALE</dd>
        </dl>
    </div>
    <div class="col-md-2">
        {{-- <dl>
            <dt class="font-weight-normal text-muted">PESO Beneficiary</dt>
            <dd class="font-weight-bold border-bottom border-dark">NO</dd>
        </dl> --}}
        <dl>
            <dt class="font-weight-normal text-muted">Birthdate</dt>
            <dd class="font-weight-bold border-bottom border-dark">
                {{ date("d/m/Y", strtotime($user_info['birthdate']))}}
            </dd>
        </dl>
    </div>
    
    <div class="col-md-2">
        <dl>
            <dt class="font-weight-normal text-muted">Nationality</dt>
            <dd class="font-weight-bold border-bottom border-dark">Philippines</dd>
        </dl>
    </div>
    <div class="col-md-2">
        <dl>
            <dt class="font-weight-normal text-muted">Yellow Card</dt>
            <dd class="font-weight-bold border-bottom border-dark">NO</dd>
        </dl>
    </div>
    
    <div class="col-md-4">
        <dl>
            <dt class="font-weight-normal text-muted">Occupation</dt>
            <dd class="font-weight-bold border-bottom border-dark">{{ $user_info['occupation']}}</dd>
        </dl>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        
    </div>
    
    
</div>