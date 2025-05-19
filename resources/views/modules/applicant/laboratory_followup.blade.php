@include('partials.applicant.header')

<div class="container">
    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Complaint Form</h3> <br />
            <small>Please send us details about the incident you would like to report. <br />Our Complaint Center will analyze your complaint and take appropriate measures to ensure that the reported situation does not occur again.</small>
        </div>
        <div class="card-body">
                
        
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fullname"><b>Full Name:</b></label>
                        <input type="text" class="form-control rounded-0" id="fullname" placeholder="Enter fullname" name="fullname">
                    </div>
        
                    <div class="form-group">
                        <label for="email"><b>Email:</b></label> 
                        <input type="text" class="form-control rounded-0" id="Email" placeholder="Enter Email" name="Email">
                    </div>
        
                    <div class="form-group">
                      <label for="complaintaddress"><b>Bussiness Complaint Address:</b></label> 
                      <input type="text" class="form-control rounded-0" id="complaintaddress" placeholder="Enter Business Address" name="complaintaddress">
                  </div>
        
                    <div class="form-group">
                        <label for="specificbrgy"><b>Specific Barangay/Street:</b></label>
                        <input type="text" class="form-control rounded-0" id="specificbrgy" placeholder="Enter Specific Barangay/Street" name="specificbrgy">
                    </div>
        
                    <div class="form-group">
                        <label for="fileToUpload"><b>Proof of Complaint:</b></label>
                        <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload">
                    </div>
        
                    <div class="form-group">
                        <label for="subject"><b>Complaint Details:</b></label>
                        <textarea id="subject" name="subject" class="form-control rounded-0" placeholder="Enter your complaint details......." style="height:200px"></textarea>
                    </div>
        
                    <button type="submit" class="btn btn-outline-primary btn-flat">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials.applicant.footer')