@include('partials.applicant.header')

<div class="container">
    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Complaint Form</h3> <br />
            <small>Please send us details about the incident you would like to report. <br />Our Complaint Center will analyze your complaint and take appropriate measures to ensure that the reported situation does not occur again.</small>
        </div>
        <div class="card-body">       
                <form>
                    <div class="form-group">
                        <label for="complaintaddress"><b>Bussiness Name:</b></label> 
                        <input type="text" class="form-control rounded-0" placeholder="Enter Business Address" data-key="BusinessName" data="req">
                      </div>

                    <div class="form-group">
                      <label for="complaintaddress"><b>Bussiness Complaint Address:</b></label> 
                      <input type="text" class="form-control rounded-0" placeholder="Enter Business Address" data-key="BusinessAddress" data="req">
                    </div>
        
                    <div class="form-group">
                        <label for="specificbrgy"><b>Specific Barangay/Street:</b></label>
                        <input type="text" class="form-control rounded-0" placeholder="Enter Specific Barangay/Street" data-key="SpecificBarangayStreet" data="req">
                    </div>
        
                    <div class="form-group">
                        <label for="fileToUpload"><b>Proof of Complaint:</b></label>
                        <input type="file" class="form-control-file complaint-photo"/>
                    </div>
        
                    <div class="form-group">
                        <label for="subject"><b>Complaint Details:</b></label>
                        <textarea class="form-control rounded-0" placeholder="Enter your complaint details......." style="height:200px" data-key="ComplaintDescription" data="req"></textarea>
                    </div>
        
                    
                    <button type="button" data-trigger="submit-complaint" class="btn btn-outline-primary btn-flat">Submit</button>
                </form>
            
        </div>
    </div>
</div>

@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/complaint.js') }}"></script>