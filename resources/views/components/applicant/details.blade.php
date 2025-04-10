
<section class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title">
            Applicant Details
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>

    <div class="card-body">
        
        <div class="row mb-2">
            <div class="col-md-4">
                <span>Full Name</span><br />
                <label for="">{{ ucwords(strtolower( $user_info['lastname'] ." " .$user_info['firstname'] . ", ".$user_info['lastname'] ))}}</label>
            </div>
            <div class="col-md-4">
                <span>Date of Birth</span><br />
                <label for="">{{ date("d/m/Y", strtotime($user_info['birthdate']))}}</label>
            </div>
            <div class="col-md-4">
                <span>Gender</span><br />
                <label for="">{{ ucfirst($user_info['sex']) }}</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <span>Email Address</span><br />
                <label for="">{{ $user_info['email'] }}</label>
            </div>
            <div class="col-md-4">
                <span>Contact No.</span><br />
                <label for="">{{ $user_info['contact'] }}</label>
            </div>
            
        </div>
    </div>
</section>